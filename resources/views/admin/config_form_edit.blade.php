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
				<legend>修改配置项</legend>
			</fieldset>
			<form class="layui-form" action="">


				<div class="layui-form-item">
					<label class="layui-form-label">配置名称</label>
					<div class="layui-input-inline">
						<input type="text" name="config_title" lay-verify="required"  value="{{$data->config_title}}"  autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux">配置名称必须填写</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">变量名称</label>
					<div class="layui-input-inline">
						<input type="text" name="config_name" lay-verify="config_name"  value="{{$data->config_name}}"  autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux">字母和数字，以及破折号和下划线</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">配置类型</label>
					<div class="layui-input-block">
						<input type="radio" name="field_type" value="input"    title="文本类型"  @if($data->field_type=='input') checked @endif>
						<input type="radio" name="field_type" value="radio" title="单选类型" @if($data->field_type=='radio') checked @endif>
						<input type="radio" name="field_type" value="textarea" title="文本域类型" @if($data->field_type=='textarea') checked @endif>
					</div>
					<div class="layui-form-mid layui-word-aux">必选</div>
				</div>

				<div class="layui-form-item" @if($data->field_type!='radio') style="display: none" @endif id="field_value">
					<label class="layui-form-label">类型值</label>
					<div class="layui-input-inline">
						<input type="text" name="field_value" lay-verify=""  value="{{$data->field_value}}"  autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux">例如: 0|关闭,1|开启 (逗号请使用英文半角)</div>
				</div>

				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">描述</label>
					<div class="layui-input-block">
						<textarea placeholder="请输入内容" name="config_tips" class="layui-textarea">{{$data->config_tips}}</textarea>
					</div>
				</div>

				<div class="layui-form-item">
					<div class="layui-input-block">
						<button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
						<button type="reset" class="layui-btn layui-btn-primary">重置</button>
						<input type="hidden" value="{{$data->id}}" name="id">
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
                    config_name: function(value, item){ //value：表单的值、item：表单的DOM对象
                        if(/^[\S]{5,20}$/.test(value) === false){
                            return '变量名称必须5到20位';
                        }
                        if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                            return '变量名称不能有特殊字符';
                        }
                        if(/(^\_)|(\__)|(\_+$)/.test(value)){
                            return '变量名称首尾不能出现下划线\'_\'';
                        }
                        if(/^\d+\d+\d$/.test(value)){
                            return '变量名称不能全为数字';
                        }
                    },
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
                        url: "{{url('admin/config/update')}}"+'/'+data.field.id,
                        data: {id:data.field.id,config_title:data.field.config_title,config_name:data.field.config_name,field_type:data.field.field_type,field_value:data.field.field_value,config_tips:data.field.config_tips,'_token':"{{csrf_token()}}"},
                        dataType: 'json',
                        success: function(msg){
                            layerTips.msg(msg.msg);
                            if(msg.status==200){
								window.parent.location.reload();
								parent.layer.close(index);
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



		</script>
	</body>

</html>