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
	<style>
		.layui-form input[type=radio]{display: inline-block}
	</style>
</head>

<body style=" background-color: gainsboro;">

<div style="margin:0px; background-color: white; margin:0 10px;">
	<blockquote class="layui-elem-quote">
		<button type="button" class="layui-btn layui-btn-small" id="add"><i class="fa fa-plus" aria-hidden="true"></i> 新增配置</button>
		<button class="layui-btn layui-btn-small layui-btn-warm" id="updateConfig">提交</button>
		<form class="layui-form" style="float:right;">
			<div class="layui-form-item" style="margin:0;">
				<label class="layui-form-label">名称</label>
				<div class="layui-input-inline">
					<input type="text" name="name" placeholder="名称，变量名.." autocomplete="off" class="layui-input">
				</div>
				<div class="layui-form-mid layui-word-aux" style="padding:0;">
					<button lay-filter="search" class="layui-btn" lay-submit><i class="fa fa-search" aria-hidden="true"></i> 查询</button>
				</div>
			</div>
		</form>
	</blockquote>
	<form action="{{url('admin/config/updateConfig')}}" method="post" id="updateConfigForm">
		{!! csrf_field() !!}
	<div id="content" style="width: 100%;height: 573px;"></div>
	</form>
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
            url: "{{asset('admin/config/list')}}", //数据源地址
            pageSize: 10,//页大小
            columns: [{
                fieldName: '名称',
                field: 'config_title',
                sortable: false
            },{
                fieldName: '变量名',
                field: 'config_name',
                sortable: false
            }, {
                fieldName: '内容',
                field: '_html',
                sortable: false
            }, {
                fieldName: '操作',
                field: 'id',
                format: function (val,obj) {
                    var html = ' <input type="hidden" name="sql_id[]" value="'+val+'"/><input type="button" value="编辑" data-action="edit" data-id="' + val + '" data-type="tabAdd" class="layui-btn layui-btn-mini form-edit-active" /> ' +
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
									var name = $that.parent('td').siblings('td[data-field=config_title]').text();
									//询问框
									layerTips.confirm('确定要删除[ <span style="color:red;">' + name + '</span> ] ？', { icon: 3, title: '系统提示' }, function (index) {
                                        $.ajax({
                                            url: "{{url('admin/config/delete')}}/"+id,
                                            data:{'_method':'delete','_token':"{{csrf_token()}}",'name':name},
                                            type: "POST",
                                            dataType:'json',
                                            success:function (data) {
                                                layerTips.msg(data.msg);
                                                if(data.status==200){
                                                    $that.parent('td').parent('tr').remove();
                                                }
                                            },
                                            error:function(er){
                                                if(er.status==403){
                                                    layerTips.msg('您没有此权限');
                                                }
                                            }
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

        function addTab(id){
            layer.open({
                title: '配置修改',
                maxmin: true,
                type: 2,
                content: "{{url('admin/config/edit/')}}"+'/'+id,
                area: ['700px', '500px']
            });
        }

        $('#add').click(function(){
            layer.open({
                title: '新增配置',
                maxmin: true,
                type: 2,
                content: "{{url('admin/config/add/')}}",
                area: ['700px', '500px']
            });
        })

		$('#updateConfig').click(function(){
		    $('#updateConfigForm').submit();
		})

    });

</script>
</body>
</html>