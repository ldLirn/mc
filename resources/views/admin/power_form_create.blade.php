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
				<legend>管理员修改</legend>
			</fieldset>

			<form class="layui-form" action="">

				<div class="layui-form-item">
					<label class="layui-form-label">角色</label>
					<div class="layui-input-block">
						<select name="role_id" lay-filter="role" lay-verify="role">
							<option value="0"></option>
								@foreach($cate as $v)
									<option value="{{$v->id}}" >{{$v->description}}</option>
								@endforeach
						</select>
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">用户名</label>
					<div class="layui-input-inline">
						<input type="text" name="name" lay-verify="username"  value=""  autocomplete="off" class="layui-input">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">邮箱</label>
					<div class="layui-input-inline">
						<input type="text" name="email" lay-verify="email"  value=""  autocomplete="off" class="layui-input">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">密码</label>
					<div class="layui-input-inline">
						<input type="password" name="password" lay-verify="pass" placeholder="请填写密码" autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux">请填写6到12位密码</div>
				</div>


				<div class="layui-form-item">
					<label class="layui-form-label">状态</label>
					<div class="layui-input-block">
						<input type="radio" name="status" value="0"    title="正常" checked>
						<input type="radio" name="status" value="1" title="禁止"  >
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
					pass: function(value) {
					  if(/^[\S]{6,12}$/.test(value) === false){
						return '密码必须6到12位';
					  }
					},
					role: function(value) {
					    if(value == '' || value == 0){
                            return '请选择角色';
						}
					},
                    username: function(value, item){ //value：表单的值、item：表单的DOM对象
                        if(/^[\S]{6,12}$/.test(value) === false){
                            return '用户名必须6到12位';
                        }
                        if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                            return '用户名不能有特殊字符';
                        }
                        if(/(^\_)|(\__)|(\_+$)/.test(value)){
                            return '用户名首尾不能出现下划线\'_\'';
                        }
                        if(/^\d+\d+\d$/.test(value)){
                            return '用户名不能全为数字';
                        }
                    }

				});

				//监听提交
				form.on('submit(demo1)', function(data) {
                    $.ajax({
                        type: 'POST',
                        url: "{{url('admin/power/list/store')}}",
                        data: {name:data.field.name,email:data.field.email,role_id:data.field.role_id,password:data.field.password,status:data.field.status,'_token':"{{csrf_token()}}"},
                        dataType: 'json',
                        success: function(msg){
                            layerTips.msg(msg.msg);
                            if(msg.status==200){
                                layer.alert(msg.msg,function(){
                                    window.parent.location.reload();
                                    parent.layer.close(index);
                                })
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