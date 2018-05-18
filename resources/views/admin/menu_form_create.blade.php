<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>表单</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no">

		<link rel="stylesheet" href="{{asset('admin/plugins/layui/css/layui.css')}}" media="all" />
		<link rel="stylesheet" href="{{asset('admin/plugins/font-awesome/css/font-awesome.min.css')}}">
	</head>

	<body>
		<div style="margin: 15px;">
			<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
				<legend>新增菜单</legend>
			</fieldset>
			<form class="layui-form" action="">

				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">菜单类型</label>
						<div class="layui-input-inline">
							<select name="pid">
								<option value="-1">请选择菜单类型</option>
								<option value="0">顶级菜单</option>
								@foreach($menu_data as $v)
									<option value="{{$v['id']}}">{{$v['title']}}</option>
								@endforeach
							</select>
						</div>
					</div>

				<div class="layui-form-item">
					<label class="layui-form-label">菜单名称</label>
					<div class="layui-input-inline">
						<input type="text" name="title" lay-verify="required"  value=""  autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux">菜单名称必须填写</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">链接地址</label>
					<div class="layui-input-inline">
						<input type="text" name="href" lay-verify=""  value=""  autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux"></div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">图标样式</label>
					<div class="layui-input-inline">
						<input type="text" name="icon" lay-verify=""  value=""  autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux"></div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">排序</label>
					<div class="layui-input-inline">
						<input type="text" name="order" lay-verify="required|number" placeholder="请输入数字，数字越小越靠前" value="50" autocomplete="off" class="layui-input">
					</div>
				</div>


				<div class="layui-form-item">
					<div class="layui-input-block">
						<button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
						<button type="reset" class="layui-btn layui-btn-primary">重置</button>
					</div>
				</div>
			</form>
		</div>
		<script type="text/javascript" src="{{asset('admin/plugins/layui/layui.js')}}"></script>
		<script>
			layui.use(['form', 'layedit', 'laydate'], function() {
				var form = layui.form(),
					layer = layui.layer,
					layedit = layui.layedit,
					laydate = layui.laydate;
                	layerTips = parent.layer === undefined ? layui.layer : parent.layer, //获取父窗口的layer对象
               		 $ = layui.jquery,
				//自定义验证规则
				form.verify({

				});
				//监听提交
				form.on('submit(demo1)', function(data) {
				    if(data.field.pid == '-1'){
						layerTips.msg('请选择菜单类型！');
						return false;
					}
                    $.ajax({
                        type: 'POST',
                        url: "{{url('admin/menu/store')}}",
                        data: {title:data.field.title,pid:data.field.pid,href:data.field.href,icon:data.field.icon,order:data.field.order,'_token':"{{csrf_token()}}"},
                        dataType: 'json',
                        success: function(msg){
                            if(msg.status==200){
                                layer.alert(msg.msg,function(){
                                    window.parent.location.reload();
                                    parent.layer.close(index);
                                })
                            }else{
                                layer.msg(msg.msg);
							}
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            layerTips.msg('ajax error');
                        },
                    });
					return false;
				});
			});



		</script>
	</body>

</html>