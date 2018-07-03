<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{config('web.web_title')}}</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="{{asset('home/css/amazeui.min.css')}}">
    <link rel="stylesheet" href="{{asset('home/css/petshow.css?6')}}">
    <link rel="stylesheet" href="{{asset('home/css/animate.min.css')}}">
    <script src="{{asset('home/js/jquery.min.js')}}"></script>
    <script src="{{asset('home/js/amazeui.min.js')}}"></script>
    <script src="{{asset('home/js/countUp.min.js')}}"></script>
    <script src="{{asset('home/js/amazeui.lazyload.min.js')}}"></script>
</head>
<body>
<header class="am-topbar am-topbar-inverse">
    <div class="amz-container">
        <h1 class="am-topbar-brand">
            <a href="#" class="am-topbar-logo">
                <img src="{{asset('home/img/logo.png?1')}}" alt="">
            </a>
        </h1>
        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
                data-am-collapse="{target: '#doc-topbar-collapse-5'}">
            <span class="am-sr-only">
                导航切换
            </span>
            <span class="am-icon-bars">
            </span>
        </button>
        <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse-5">
            <ul class="am-nav am-nav-pills am-topbar-nav">
                <li class="am-active">
                    <a href="/">
                        首页
                    </a>
                </li>
                @foreach($nav_data as $v)
                    @if(empty($v['children']))
                        <li>
                            <a href="{{$v['nav_url']}}" target="_blank">{{$v['nav_name']}}</a>
                        </li>
                    @else
                        <li class="am-dropdown" data-am-dropdown="">
                            <a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="javascript:;">
                                {{$v['nav_name']}}
                                <span class="am-icon-caret-down">
                                </span>
                            </a>
                            <ul class="am-dropdown-content">
                                @foreach($v['children'] as $vo)
                                    <li>
                                        <a href="{{$vo['nav_url']}}" target="_blank">
                                            {{$vo['nav_name']}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>


            <div class="am-topbar-right">
                @if (Auth::guest())
                    <a class="am-btn am-btn-primary am-topbar-btn am-btn-sm" href="{{ url('/login').'?redirectUrl='.url()->full() }}" >登录</a>
                    <a class="am-btn am-btn-secondary am-topbar-btn am-btn-sm" href="{{url('/register')}}" >注册</a>
                @else
                    <a class="am-btn am-btn-primary am-topbar-btn am-btn-sm" href="{{url('/user')}}" >{{ Auth::user()->name }}</a>
                    <a class="am-btn am-btn-secondary am-topbar-btn am-btn-sm" href="{{url('/logout')}}" >退出</a>
                @endif
            </div>
        </div>
    </div>
</header>


@yield('content')

<footer class="am_footer">
    <div class="am_footer_con">
        <div class="am_footer_link">
            <span>关于萌宠秀</span>
            <ul>
                <li><a href="###">关于我们</a></li>
                <li><a href="###">发展历程</a></li>
                <li><a href="###">友情链接</a></li>
            </ul>
        </div>


        <div class="am_footer_don">
            <span>萌宠秀</span>
            <dl>
                <dt><img src="{{asset('home/img/footdon.png?1')}}" alt=""></dt>
                <dd>一起Show我们的爱宠吧！萌宠秀是图片配文字、涂鸦、COSPLAY的移动手机社区，这里有猫狗鱼龟兔子仓鼠龙猫等各种萌图。
                   </dd>

            </dl>
        </div>

        <div class="am_footer_erweima">
            <div class="am_footer_weixin"><img src="{{asset('home/img/wx.jpg')}}" alt="">
                <div class="am_footer_d_gzwx am-icon-weixin"> 关注微信</div>
            </div>
        </div>

    </div>
    <div class="am_info_line">Copyright(c)2018 <span>萌宠秀</span> All Rights Reserved.</div>
</footer>
<script src="{{asset('home/js/petshow.js')}}"></script>
</body>
</html>



