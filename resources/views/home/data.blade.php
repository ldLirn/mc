@extends('layout.home')
@section('content')
<div class="am_user">
    <div class="am_user_head">
        <div class="am_user_head_content">
            <div class="am_user_head_l">
                <div class="am_user_head_l_ico"> <img src="{{asset('home/img/tx.jpg')}}" alt=""></div>
                <div class="am_user_head_l_ico_info">
                    <span class="am_user_head_l_name">{{ Auth::user()->name }}</span>
                    <span class="am_user_head_l_map"><i class="am-icon-map-marker"></i> {{ $address[1] }}{{ $address[2] }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="center-block">
        <form class="am-form am-form-horizontal">
            <div class="am-form-group">
                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">昵称</label>
                <div class="am-u-sm-10">
                    <input type="text" id="doc-ipt-3" placeholder="输入你的昵称">
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-pwd-2" class="am-u-sm-2 am-form-label">密码</label>
                <div class="am-u-sm-10">
                    <input type="password" id="doc-ipt-pwd-2" placeholder="设置一个密码吧">
                </div>
            </div>


            <div class="am-form-group">
                <div class="am-u-sm-10 am-u-sm-offset-2">
                    <button type="submit" class="am-btn am-btn-default">确认修改</button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
<script>
console.log($.AMUI);
 $(function(){
  if ($(window).width() < 600 ) {
 $('.am_list_item_text').each(
  function(){
     if($(this).text().length >= 26){
        $(this).html($(this).text().substr(0,26)+'...');
     }});}[]

});

</script>
