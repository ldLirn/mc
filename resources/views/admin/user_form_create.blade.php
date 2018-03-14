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
		<link rel="stylesheet" type="text/css" href="{{asset('common/css/ycbootstrap.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('common/css/reset.css')}}">

	</head>

	<body>
		<div style="margin: 15px;">
			<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
				<legend>添加会员</legend>
			</fieldset>
			<form class="layui-form" action="" enctype="multipart/form-data">
				<div class="layui-form-item">
					<label class="layui-form-label">登录名</label>
					<div class="layui-input-inline">
						<input type="text" name="name" lay-verify="required|name"  value=""  autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux">登录名必须填写</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">昵称</label>
					<div class="layui-input-inline">
						<input type="text" name="nickname" lay-verify=""  value=""  autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">头像</label>
				<div class="layui-upload">
					<div class="ycupload-line"></div>
					<div style="height:30px;"></div>
					<div  style="min-height:1px;">
						<div class="container">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-right:0;padding-left:36px;">

									<div style="min-height:1px;line-height:160px;text-align:center;position:relative;" ontouchstart="">
										<div class="cover-wrap" style="display:none;position:fixed;left:0;top:0;width:100%;height:100%;background: rgba(0, 0, 0, 0.4);z-index: 10000000;text-align:center;">
											<div class="" style="width:900px;height:600px;margin:100px auto;background-color:#FFFFFF;overflow: hidden;border-radius:4px;">
												<div id="clipArea" style="margin:10px;height: 520px;"></div>
												<div class="" style="height:56px;line-height:36px;text-align: center;padding-top:8px;">
													<input id="clipBtn" type="button" value="确定" style="width:120px;height: 36px;border-radius: 4px;background-color:#ff8a00;color: #FFFFFF;font-size: 14px;text-align: center;line-height: 36px;outline: none;">
												</div>
											</div>
										</div>
										<div id="view" style="width:214px;height:160.5px;" title="请上传图片"></div>
										<div style="height:10px;"></div>
										<div class="" style="width:140px;height:32px;border-radius: 4px;background-color:#ff8a00;color: #FFFFFF;font-size: 14px;text-align:center;line-height:32px;outline:none;margin-left:37px;position:relative;">
											点击上传头像
											<input type="file" id="file" name="head" style="cursor:pointer;opacity:0;filter:alpha(opacity=0);width:100%;height:100%;position:absolute;top:0;left:0;">
											<input type="hidden" name="base_img" id="base_img" value="">
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">邮箱</label>
					<div class="layui-input-inline">
						<input type="text" name="email" lay-verify="required|email"  value=""  autocomplete="off" class="layui-input">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">QQ号码</label>
					<div class="layui-input-inline">
						<input type="text" name="qq" lay-verify="required|number"  value=""  autocomplete="off" class="layui-input">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">手机号码</label>
					<div class="layui-input-inline">
						<input type="text" name="telphone" lay-verify="required|phone"  value=""  autocomplete="off" class="layui-input">
					</div>
				</div>

				<div class="layui-form-item"  id="field_value">
					<label class="layui-form-label">登录密码</label>
					<div class="layui-input-inline">
						<input type="password" name="password" lay-verify="required|pass"  value=""  autocomplete="off" class="layui-input">
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
		<script type="text/javascript" src="{{asset('common/js/jquery.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('admin/plugins/layui/layui.js')}}"></script>
		<script src="{{asset('common/js/cover_js/iscroll-zoom.js')}}" type="text/javascript" charset="utf-8"></script>
		<script src="{{asset('common/js/cover_js/hammer.js')}}" type="text/javascript" charset="utf-8"></script>
		<script src="{{asset('common/js/cover_js/lrz.all.bundle.js')}}" type="text/javascript" charset="utf-8"></script>
		<script src="{{asset('common/js/cover_js/jquery.photoClip.min.js')}}" type="text/javascript" charset="utf-8"></script>

		<script>
			layui.use(['form'], function() {
				var form = layui.form(),
					layer = layui.layer,
                	layerTips = parent.layer === undefined ? layui.layer : parent.layer, //获取父窗口的layer对象
               		 $ = layui.jquery;
                //普通图片上传

				//自定义验证规则
				form.verify({
                    name: function(value, item){ //value：表单的值、item：表单的DOM对象
                        if(/^[\S]{5,12}$/.test(value) === false){
                            return '用户名必须5到12位';
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
                    },
                    pass: [
                        /^[\S]{6,12}$/
                        ,'密码必须6到12位，且不能出现空格'
                    ]
                });
				//监听提交
				form.on('submit(demo1)', function(data) {
				    if(data.field.field_type == 'radio'){
				        if(data.field.field_value == ''){
                            layerTips.msg('配置类型为单选时，类型值必须填写');
                            return false;
						}
					}
                    $.ajax({
                        type: 'POST',
                        url: "{{url('admin/user/store')}}",
                        data: {name:data.field.name,nickname:data.field.nickname,email:data.field.email,qq:data.field.qq,telphone:data.field.telphone,password:data.field.password,base_img:data.field.base_img,'_token':"{{csrf_token()}}"},
                        dataType: 'json',
                        success: function(msg){
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


                $('.layui-form-radio').on('click',function(){
                    if($(this).hasClass('layui-form-radioed') === true){
                        var code = $(this).prev('input[name=field_type]:checked').val();
                        if(code=='radio'){
                            $('#field_value').show();
                        }else{
                            $('#field_value').hide();
                        }
					}
                })
			});

            var clipArea = new bjj.PhotoClip("#clipArea", {
                size: [428, 321],// 截取框的宽和高组成的数组。默认值为[260,260]
                outputSize: [428, 321], // 输出图像的宽和高组成的数组。默认值为[0,0]，表示输出图像原始大小
                //outputType: "jpg", // 指定输出图片的类型，可选 "jpg" 和 "png" 两种种类型，默认为 "jpg"
                file: "#file", // 上传图片的<input type="file">控件的选择器或者DOM对象
                view: "#view", // 显示截取后图像的容器的选择器或者DOM对象
                ok: "#clipBtn", // 确认截图按钮的选择器或者DOM对象
                loadStart: function() {
                    // 开始加载的回调函数。this指向 fileReader 对象，并将正在加载的 file 对象作为参数传入
                    $('.cover-wrap').fadeIn();
                    console.log("照片读取中");
                },
                loadComplete: function() {
                    // 加载完成的回调函数。this指向图片对象，并将图片地址作为参数传入
                    console.log("照片读取完成");
                },
                //loadError: function(event) {}, // 加载失败的回调函数。this指向 fileReader 对象，并将错误事件的 event 对象作为参数传入
                clipFinish: function(dataURL) {
                    // 裁剪完成的回调函数。this指向图片对象，会将裁剪出的图像数据DataURL作为参数传入
                    $('.cover-wrap').fadeOut();
                    $('#view').css('background-size','100% 100%');
                    $('#base_img').val(dataURL);
                }
            });
		</script>
	</body>

</html>