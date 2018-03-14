<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>添加角色</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no">

		<link rel="stylesheet" href="{{asset('admin/plugins/layui/css/layui.css')}}" media="all" />
		<link rel="stylesheet" href="{{asset('admin/plugins/font-awesome/css/font-awesome.min.css')}}">
		<script type="text/javascript" src="{{asset('common/js/jquery.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('admin/plugins/layui/layui.js')}}"></script>
	</head>

	<body>
		<div style="margin: 15px;">
			<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
				<legend>添加角色</legend>
			</fieldset>

			<form class="layui-form" action="">

				<div class="layui-form-item">
					<label class="layui-form-label">角色名称</label>
					<div class="layui-input-inline">
						<input type="text" name="name" lay-verify="username"  value=""  autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux">角色名称必须是字母组成</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">中文描述</label>
					<div class="layui-input-inline">
						<input type="text" name="description" lay-verify="required"  value=""  autocomplete="off" class="layui-input">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">级别</label>
					<div class="layui-input-inline">
						<select name="level" lay-filter="level" lay-verify="required" style="width: 50%">
							<option value=""></option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
					<div class="layui-form-mid layui-word-aux">级别越高拥有的权限越大</div>
				</div>


				<div class="layui-form-item">
					<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
						<legend>权限</legend>
					</fieldset>
					<div class="layui-input-block">
						@php $num = 0;@endphp
						@foreach($power as $k=>$v)
							@php ++$num;@endphp
							<div class="layui-form-item" id="checkFull{{$num}}">
								<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;border: none">
									<legend>
										<div class="layui-form-item">
											<div class="layui-input-block" style="margin-left: 10px;" id='checkAll{{$num}}'>
												<input type="checkbox" name="permission[]" title={{$k}}>
											</div>
										</div>
									</legend>
								</fieldset>
								<div class="layui-input-block">
									@foreach($power[$k] as $m=>$n)

											<div class="layui-input-block" style="margin-left:0;overflow: hidden">
												<div style="width: 20%;float: left;" class="item{{$num}}" id="itemMain{{$n->id}}">
													<input type="checkbox"  name="permission1[]" value="{{$n->id}}"  class="value" title="{{$n->description}}">
												</div>
												@foreach($n['child'] as $p)
													@foreach($p as $vo)
													<div style="width: 20%;float: left;" class="item{{$num}} items" id="item{{$vo['id']}}">
														<input type="checkbox"  name="permission1[]" value="{{$vo['id']}}" class="value" title="{{$vo['description']}}">
													</div>
														<script>
                                                            $('#itemMain{{$n->id}}').click(function(){
                                                                var count_check = $('#checkFull{{$num}}').find('input.value').length;
                                                                var count_checked = $('#checkFull{{$num}}').find('input.value:checked').length;
                                                                if(count_check == count_checked){
                                                                    $('#checkAll{{$num}}').find('div.layui-form-checkbox').addClass('layui-form-checked')
                                                                    $('#checkAll{{$num}}').find('input').prop('checked','checked');
                                                                }else{
                                                                    $('#checkAll{{$num}}').find('div.layui-form-checkbox').removeClass('layui-form-checked')
                                                                    $('#checkAll{{$num}}').find('input').prop('checked','');
                                                                }
															})
                                                            $('#item{{$vo['id']}}').click(function () {
                                                                var count_check = $('#checkFull{{$num}}').find('input.value').length;
                                                                var count_checked = $('#checkFull{{$num}}').find('input.value:checked').length;
                                                                if(count_check == count_checked){
                                                                    $('#checkAll{{$num}}').find('div.layui-form-checkbox').addClass('layui-form-checked')
                                                                    $('#checkAll{{$num}}').find('input').prop('checked','checked');
                                                                }else{
                                                                    $('#checkAll{{$num}}').find('div.layui-form-checkbox').removeClass('layui-form-checked')
                                                                    $('#checkAll{{$num}}').find('input').prop('checked','');
                                                                }
                                                                if($(this).find('div.layui-form-checkbox').hasClass('layui-form-checked')){
                                                                    $('#itemMain{{$vo["pid"]}}').find('div.layui-form-checkbox').addClass('layui-form-checked');
                                                                    $('#itemMain{{$vo["pid"]}}').find('input').prop('checked','checked');
                                                                }else{
                                                                    if($(this).siblings('.items').find('div.layui-form-checkbox').hasClass('layui-form-checked') === false){
                                                                        $('#itemMain{{$vo["pid"]}}').find('div.layui-form-checkbox').removeClass('layui-form-checked');
                                                                        $('#itemMain{{$vo["pid"]}}').find('input').prop('checked','');
                                                                    }
                                                                }

                                                            })
														</script>
													@endforeach
												@endforeach
											</div>


									@endforeach
								</div>

							</div>
							<script>
                                $('#checkAll{{$num}}').click(function () {
                                   if($(this).find('div.layui-form-checkbox').hasClass('layui-form-checked')){
                                       $('.item{{$num}}').find('div.layui-form-checkbox').addClass('layui-form-checked');
                                       $('.item{{$num}}').find('input').prop('checked','checked');
								   }else{
                                       $('.item{{$num}}').find('div.layui-form-checkbox').removeClass('layui-form-checked');
                                       $('.item{{$num}}').find('input').prop('checked','');
								   }
                                })
							</script>
						@endforeach
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
                    username: function(value, item){ //value：表单的值、item：表单的DOM对象
                        if(/^[\S]{6,12}$/.test(value) === false){
                            return '角色名称必须6到12位';
                        }
                        if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                            return '角色名称不能有特殊字符';
                        }
                        if(/(^\_)|(\__)|(\_+$)/.test(value)){
                            return '角色名称首尾不能出现下划线\'_\'';
                        }
                        if(/^\d+\d+\d$/.test(value)){
                            return '角色名称不能全为数字';
                        }
                    }

				});
				//监听提交
				form.on('submit(demo1)', function(data) {
                    var chkIds = '';
                    $("input:checkbox:checked").each(function(i){
                        if($(this).hasClass('value')){
                            chkIds += $(this).val() + ",";
						}
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{url('admin/power/role/store')}}",
                        data: {name:data.field.name,description:data.field.description,level:data.field.level,permission:chkIds,'_token':"{{csrf_token()}}"},
                        dataType: 'json',
                        success: function(msg){
                            if(msg.status == 200){
                                layer.alert(msg.msg,function(){
                                    window.parent.location.reload();
                                    parent.layer.close(index);
                                })
                            }else{
                                layerTips.msg(msg.msg);
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