<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>{{config('web.web_title')}}--注册</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <link rel="stylesheet" href="{{asset('home/css/amazeui.min.css')}}">
  <link rel="stylesheet" href="{{asset('home/css/app.css')}}">
</head>
<body>
<div class="am-g myapp-login">
	<div class="myapp-login-bg">
		  <div data-am-widget="tabs"
	       class="am-tabs am-tabs-d2"
	        >
	      <ul class="am-tabs-nav am-cf">
	          <li class="am-active"><a href="[data-tab-panel-0]">邮箱注册</a></li>
	          <li class=""><a href="[data-tab-panel-1]">手机注册</a></li>
	         
	      </ul>
	      <div class="am-tabs-bd">
	          <div data-tab-panel-0 class="am-tab-panel am-active">
				<form action="{{ url('/register') }}" method="post" class="am-form">
					<fieldset>
							<div class="am-form-group">
								<label for="doc-vld-name">邮箱</label>
								<input type="email" id="doc-vld-email-1" minlength="3" name="email" placeholder="邮箱地址" class="am-form-field"  required/>
							</div>
							<div class="am-form-group">
								<label for="doc-vld-name">验证码</label>
								<input type="text" id="doc-vld-text-1" minlength="3" name="email" placeholder="验证码" class="am-form-field"  required/>
							</div>
							<div class="am-form-group">
								<label for="doc-vld-pwd-1">密码</label>
								<input type="password" id="doc-vld-pwd-1" name="password" placeholder="" pattern="^\d{6}$" required/>
							</div>
							<div class="am-form-group">
								<label for="doc-vld-pwd-2">确认密码：</label>
								<input type="password" id="doc-vld-pwd-2" name="password_confirmation" placeholder="请与上面输入的值一致" data-equal-to="#doc-vld-pwd-1" required/>
							</div>

							<div class="am-form-group myapp-login-treaty"><label class="am-form-label"></label><label class="am-checkbox-inline" > <input type="checkbox" value="yes" name="agree" minchecked="2" maxchecked="4" required="" >已同意使用条约 </label></div>


						<button class="myapp-login-button am-btn am-btn-secondary" type="submit">注册</button>
						<input type="hidden" name="_token" value="{{csrf_token()}}">
					</fieldset>
					<legend>忘记密码?</legend>

					<div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
						<div class="am-modal-dialog">
							<div class="am-modal-hd">使用条款</div>
							<div class="am-modal-bd">
								{{config('web.clause')}}
							</div>
							<div class="am-modal-footer">
								<span class="am-modal-btn" data-am-modal-cancel>同意</span>
								<span class="am-modal-btn" data-am-modal-confirm>不同意</span>
							</div>
						</div>
					</div>

				</form>
	          </div>
	          <div data-tab-panel-1 class="am-tab-panel ">
	            <form action="" class="am-form" id="register">
					<fieldset>
						<div class="am-form-group">
						<label for="doc-vld-name">手机号</label>
						<input type="text" id="doc-vld-name" minlength="3" placeholder="Number" class="am-form-field" required/>
						</div>
						<div class="am-form-group">
						<label for="doc-vld-name">验证码</label>
						<input type="password" id="doc-vld-name" minlength="3" placeholder="Code" class="am-form-field" required/>
						</div>
						<div class="am-form-group myapp-login-treaty"><label class="am-form-label"></label><label class="am-checkbox-inline"> <input type="checkbox" value="橘子" name="docVlCb" minchecked="2" maxchecked="4" required="">已同意使用条约 </label></div>
						<button class="myapp-login-button am-btn am-btn-secondary" >登录</button>
					</fieldset>
					<legend>
						@if(session('msg'))
							<div class="mark">
								<p>{{session('msg')}}</p>
							</div>
						@endif
					</legend>
				</form>
	          </div>
	        
	      </div>
	  </div>
	</div>
</div>
<!--[if (gte IE 9)|!(IE)]><!-->
<script src="{{asset('home/js/jquery.min.js')}}"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<![endif]-->
<script src="{{asset('home/js/amazeui.min.js')}}"></script>
<script src="{{asset('home/js/amazeui.dialog.min.js')}}"></script>
<script src="{{asset('home/js/app.js')}}"></script>
<script>
    $(function() {
        var $confirm = $('#my-confirm');
        var $confirmBtn = $confirm.find('[data-am-modal-confirm]');
        var $cancelBtn = $confirm.find('[data-am-modal-cancel]');
        $confirmBtn.off('click.confirm.modal.amui').on('click', function() {
            console.log(333);
        });

        $cancelBtn.off('click.cancel.modal.amui').on('click', function() {
            $confirm.hide();
        });
    });
</script>
</body>
</html>