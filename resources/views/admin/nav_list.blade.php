<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>btable</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">

    <link rel="stylesheet" href="{{asset('admin/plugins/layui/css/layui.css')}}" media="all" />
    <link rel="stylesheet" href="{{asset('admin/plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/btable.css')}}" />
</head>

<body style=" background-color: gainsboro;">

    <div style="margin:0px; background-color: white; margin:0 10px;">
        <blockquote class="layui-elem-quote">
            <button type="button" class="layui-btn layui-btn-small" id="getAll"><i class="fa fa-plus" aria-hidden="true"></i> 添加导航</button>
            <form class="layui-form" style="float:right;">
                <div class="layui-form-item" style="margin:0;">
                    <label class="layui-form-label">名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" placeholder="导航名.." autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux" style="padding:0;">
                        <button lay-filter="search" class="layui-btn" lay-submit><i class="fa fa-search" aria-hidden="true"></i> 查询</button>
                    </div>
                </div>
            </form>
        </blockquote>
        <div id="content" style="width: 100%;height: 533px;"></div>
    </div>

    <script type="text/javascript" src="{{asset('admin/plugins/layui/layui.js')}}"></script>
    <script>
        layui.config({
            base: "{{asset('admin/js')}}/",
            v: new Date().getTime()
        }).use(['btable', 'form','element'], function () {
            var btable = layui.btable(),
                $ = layui.jquery,
                layerTips = parent.layer === undefined ? layui.layer : parent.layer, //获取父窗口的layer对象
                layer = layui.layer,//获取当前窗口的layer对象;
                form = layui.form();

            btable.set({
                openWait: true,//开启等待框
                elem: '#content',
                url: "{{asset('admin/nav/list')}}", //数据源地址
                pageSize: 10,//页大小
                columns: [{ //配置数据列
                    fieldName: '导航名', //显示名称
                    field: 'nav_name', //字段名
                    sortable: false //是否显示排序
                }, {
                    fieldName: '是否显示',
                    field: 'is_show',
                    sortable: false
                },{
                    fieldName: '位置',
                    field: 'nav_wz',
                    sortable: false
                }, {
                    fieldName: '操作',
                    field: 'id',
                    format: function (val,obj) {
                        var html = '<input type="button" value="编辑" data-action="edit" data-id="' + val + '" data-type="tabAdd" class="layui-btn layui-btn-mini form-edit-active" /> ' +
                            '<input type="button" value="删除" data-action="del" data-id="' + val + '" class="layui-btn layui-btn-mini layui-btn-danger" />';
                        return html;
                    }
                }],
                even: true,//隔行变色
                field: 'id', //主键ID
                skin: 'row',
                checkbox: false,//是否显示多选框
                paged: true, //是否显示分页
                singleSelect: false, //只允许选择一行，checkbox为true生效
                onSuccess: function ($elem) { //$elem当前窗口的jq对象
                    $elem.children('tr').each(function () {
                        $(this).children('td:last-child').children('input').each(function () {
                            var $that = $(this);
                            var action = $that.data('action');
                            var id = $that.data('id');
                            $that.on('click', function () {
                                switch (action) {
                                    case 'edit':
                                        addTab(id);
                                        break;
                                    case 'del': //删除
                                        var name = $that.parent('td').siblings('td[data-field=nav_name]').text();
                                        //询问框
                                        layerTips.confirm('确定要删除[ <span style="color:red;">' + name + '</span> ] ？', { icon: 3, title: '系统提示' }, function (index) {
                                            $.ajax({
                                                type: 'delete',
                                                url: "{{url('admin/nav/destroy')}}",
                                                data: {id:id,'_token':"{{csrf_token()}}",name:name},
                                                dataType: 'json',
                                                success: function(msg){
                                                    layerTips.msg(msg.msg);
                                                    if(msg.status==200){
                                                        $that.parent('td').parent('tr').remove();
                                                    }
                                                },
                                                error: function(er) {
                                                    if(er.status==403){
                                                        layerTips.msg('您没有此权限');
                                                    }else{
                                                        layerTips.msg('ajax error');
                                                    }
                                                },
                                            });
                                        });
                                        break;
                                }
                            });
                        });
                    });
                }
            });
            btable.render();
            //监听搜索表单的提交事件
            form.on('submit(search)', function (data) {
                btable.get(data.field);
                return false;
            });
            $(window).on('resize', function (e) {
                var $that = $(this);
                $('#content').height($that.height() - 92);
            }).resize();

            function addTab(id){
                layer.open({
                    title: '修改导航',
                    maxmin: true,
                    type: 2,
                    content: "{{url('admin/nav/edit/')}}"+'/'+id,
                    area: ['100%', '100%']
                });
            }

            $('#getAll').click(function(){
                layer.open({
                    title: '添加导航',
                    maxmin: true,
                    type: 2,
                    content: "{{url('admin/nav/create')}}",
                    area: ['90%', '80%']
                });
            })
        });

    </script>
</body>

</html>