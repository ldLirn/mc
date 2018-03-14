<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>萌宠之家 后台登录</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="后台登录">
        <meta name="author" content="lirn">

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="{{asset('admin/assets/css/reset.css') }}">
        <link rel="stylesheet" href="{{asset('admin/assets/css/supersized.css') }}">
        <link rel="stylesheet" href="{{asset('admin/assets/css/style.css') }}">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <style>
            .page-container img{
                margin-top: 25px;
                border-radius:6px;
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        <div class="page-container">
            <h1>Login</h1>
            <em class="msg"></em>
            <div class="form">
                <input type="text" name="username" class="username" placeholder="用户名">
                <input type="password" name="password" class="password" placeholder="密码">
                <input type="text" name="captcha" class="captcha" placeholder="验证码" style="width: 147px;float: left">
                <img src="{!! Captcha::src() !!}" id="captcha">
                <button type="submit" id="submit">登录</button>
                <div class="error"><span>+</span></div>
                <input type="hidden" id="src" value="{{url('admin/post_login')}}">
                <input type="hidden" id="admin_index" value="{{url('admin/index')}}">
                {!! csrf_field() !!}
            </div>
        </div>
        <!-- Javascript -->
        <script src="{{asset('admin/assets/js/jquery-1.8.2.min.js') }}"></script>
        <script src="{{asset('admin/assets/js/supersized.3.2.7.min.js') }}"></script>
        <script src="{{asset('admin/assets/js/supersized-init.js') }}"></script>
        <script src="{{asset('admin/assets/js/scripts.js') }}"></script>
        <script>
            $('#captcha').click(function(){
                console.log("{!! Captcha::src() !!}");
                $(this).attr('src','{!! Captcha::src() !!}' + Math.random());
            })
        </script>
    </body>
</html>

