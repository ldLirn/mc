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
				<form action="{{ url('/postRegister') }}" method="post" class="am-form">
					<fieldset>
							<div class="am-form-group">
								<label for="doc-vld-name">邮箱</label>
								<input type="email" id="doc-vld-name" minlength="3" name="email" placeholder="邮箱地址" class="am-form-field email"  required/>
								<button type="button" class="myapp-login-button-code am-btn am-btn-secondary am-btn-xs" id="btnSendCode">发送邮件</button>
							</div>
							<div class="am-form-group">
								<label for="doc-vld-name">验证码</label>
								<input type="text" id="doc-vld-name" minlength="3" name="code" placeholder="验证码" class="am-form-field"  required/>
							</div>
							<div class="am-form-group">
								<label for="doc-vld-pwd-1">密码</label>
								<input type="password" id="doc-vld-name" minlength="3" name="password" placeholder="" pattern="^\d{6}$" required/>
							</div>
							<div class="am-form-group">
								<label for="doc-vld-pwd-2">确认密码：</label>
								<input type="password" id="doc-vld-name" name="password_confirmation" placeholder="请与上面输入的值一致" data-equal-to="#doc-vld-pwd-1" required/>
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
	            <form action="{{ url('/postRegister') }}" method="post" class="am-form" id="register">
					<fieldset>
						<div class="am-form-group">
						<label for="doc-vld-name">手机号</label>
						<input type="text" id="doc-vld-name" minlength="3" placeholder="Number" class="am-form-field" required/>
							<button type="button" class="myapp-login-button-code am-btn am-btn-secondary am-btn-xs" id="btnSendCode">发送验证码</button>
						</div>
						<div class="am-form-group">
						<label for="doc-vld-name">验证码</label>
						<input type="password" id="doc-vld-name" minlength="3" placeholder="Code" class="am-form-field" required/>
						</div>
						<div class="am-form-group">
							<label for="doc-vld-pwd-1">密码</label>
							<input type="password" id="doc-vld-name" minlength="3" name="password" placeholder="" pattern="^\d{6}$" required/>
						</div>
						<div class="am-form-group">
							<label for="doc-vld-pwd-2">确认密码：</label>
							<input type="password" id="doc-vld-name" name="password_confirmation" placeholder="请与上面输入的值一致" data-equal-to="#doc-vld-pwd-1" required/>
						</div>
						<div class="am-form-group myapp-login-treaty"><label class="am-form-label"></label><label class="am-checkbox-inline"> <input type="checkbox" value="橘子" name="docVlCb" minchecked="2" maxchecked="4" required="">已同意使用条约 </label></div>
						<button class="myapp-login-button am-btn am-btn-secondary" >登录</button>
						<input type="hidden" name="_token" value="{{csrf_token()}}">
					</fieldset>
					<legend>
						<a href="{{url('/login')}}">已有账号？</a>
					</legend>
				</form>
	          </div>
	        
	      </div>
	  </div>
	</div>
</div>

<div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
	<div class="am-modal-dialog">
		<div class="am-modal-bd" id="content">
			Hello world！
		</div>
		<div class="am-modal-footer">
			<span class="am-modal-btn" id="close">确定</span>
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
<script src="{{asset('home/js/jquery.cookie.js')}}"></script>
<script>
	$('.myapp-login-button-code').click(function(){
        valid_yz();
	})

	$('#close').click(function(){
        $('#my-alert').hide();
	})
    function prevent(e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;
    }
    function digitInput(el, e) {
        var ee = e || window.event; // FF、Chrome IE下获取事件对象
        var c = e.charCode || e.keyCode; //FF、Chrome IE下获取键盘码
        //var txt = $('label').text();
        //$('label').text(txt + ' ' + c);
        var val = el.val();
        if (c == 110 || c == 190){ // 110 (190) - 小(主)键盘上的点
            (val.indexOf(".") >= 0 || !val.length) && prevent(e); // 已有小数点或者文本框为空，不允许输入点
        } else {
            if ((c != 8 && c != 46 && // 8 - Backspace, 46 - Delete
                    (c < 37 || c > 40) && // 37 (38) (39) (40) - Left (Up) (Right) (Down) Arrow
                    (c < 48 || c > 57) && // 48~57 - 主键盘上的0~9
                    (c < 96 || c > 105)) // 96~105 - 小键盘的0~9
                || e.shiftKey) { // Shift键，对应的code为16
                prevent(e); // 阻止事件传播到keypress
            }
        }
    }
    $(function(){
        $("input[name='email']").keydown(function(e) {
            digitInput($(this), e);
        });
    });
    var InterValObj; //timer变量，控制时间
    var count = 180; //间隔函数，1秒执行
    var curCount;//当前剩余秒数
    function valid_yz() {
        var email = $('input[name=email]').val();
        var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(reg.test(email) === false){
            $('#content').html('您输入的邮箱地址不正确');
            $('#my-alert').show();
            $('#my-alert').css('opacity',1)
			return false;
		}
        curCount = count;
        $.post("{{url('/send_register_email')}}",{email:email,'_token':"{{csrf_token()}}"},function (msg) {
            if(msg.status=='10000'){
                $("#btnSendCode").attr("disabled", "true");
                $("#btnSendCode").css("background-color", "#d2ccc9");
                $("#btnSendCode").html( curCount + "秒");
                InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
            }else{
               $('#content').html(msg.info);
               $('#my-alert').show();
               $('#my-alert').css('opacity',1)
            }
        })
    }
    /*防刷新：检测是否存在cookie*/
    if($.cookie("captcha")){
        var curCount = $.cookie("captcha");
        var btn = $('#btnSendCode');
        btn.html( curCount + "秒").attr('disabled',true).css('cursor','not-allowed');
        var resend = setInterval(function(){
            curCount--;
            if (curCount > 0){
                btn.html(curCount + "秒").attr('disabled',true).css('cursor','not-allowed');
                btn.css("background-color", "#d2ccc9");
                $.cookie("captcha", count, {path: '/', expires: (1/86400)*curCount});
            }else {
                clearInterval(resend);
                btn.css("background-color", "#fff");
                btn.html("重新发送").removeClass('disabled').removeAttr('disabled style');
            }
        }, 1000);
    }
    //timer处理函数
    function SetRemainTime() {
        $.cookie("captcha", curCount, {path: '/', expires: (1/86400)*curCount});
        if (curCount == 0) {
            window.clearInterval(InterValObj);//停止计时器
            $("#btnSendCode").removeAttr("disabled");//启用按钮
            btn.css("background-color", "#fff");
            $("#btnSendCode").html("重新发送");
        }
        else {
            curCount--;
            $("#btnSendCode").html(curCount + "秒");
        }
    }
</script>

</body>
</html>