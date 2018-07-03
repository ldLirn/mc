<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>{{config('web.web_title')}}--登录</title>
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
	          <li class="am-active"><a href="[data-tab-panel-0]">帐号登录</a></li>
	          <li class=""><a href="[data-tab-panel-1]">手机登录</a></li>
	         
	      </ul>
			  @if(count($errors)>0)
				  <div class="mark">
					  @foreach($errors->all() as $error)
						  <p>{{$error}}</p>
					  @endforeach
				  </div>
			  @endif
			  @if(session('msg'))
				  <div class="mark">
					  <p>{{session('msg')}}</p>
				  </div>
			  @endif
	      <div class="am-tabs-bd">
	          <div data-tab-panel-0 class="am-tab-panel am-active">
				<form action="{{ url('/login') }}" method="post" class="am-form">
					<fieldset>
						<div class="am-form-group">
						<label for="doc-vld-name">帐号</label>
						<input type="text" id="doc-vld-name" minlength="3" name="login" placeholder="User ID" class="am-form-field" required/>
						</div>
						<div class="am-form-group">
						<label for="doc-vld-name">密码</label>
						<input type="password" id="doc-vld-name" minlength="3" name="password" placeholder="User Password" class="am-form-field" required/>
						</div>
						<button class="myapp-login-button am-btn am-btn-secondary" type="submit">登录</button>
						<input type="hidden" name="_token" value="{{csrf_token()}}">
					</fieldset>
					<legend><a href="{{url('/reset')}}">忘记密码?</a>  &nbsp;&nbsp;&nbsp;   <a href="{{url('/register')}}" class="reg">还没帐号？</a></legend>
				</form>
	          </div>
	          <div data-tab-panel-1 class="am-tab-panel ">
	            <form action="" class="am-form">
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
						<button class="myapp-login-button am-btn am-btn-secondary" type="submit">登录</button>
					</fieldset>
					<legend>忘记密码?</legend>
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
<script src="{{asset('home/js/app.js')}}"></script>
</body>
</html>