
jQuery(document).ready(function() {

    $('#submit').click(function(){
        var username = $.trim($('.page-container').find('.username').val());
        var password = $.trim($('.page-container').find('.password').val());
        var captcha = $.trim($('.page-container').find('.captcha').val());
        var token = $('[name=_token]').val();
        var admin_index = $('#admin_index').val();
        console.log(token);
        var src = $('#src').val();
        if(username == '' || username.length < 5) {
            $('.page-container').find('.error').fadeOut('fast', function(){
                $(this).css('top', '27px');
            });
            $('.page-container').find('.error').fadeIn('fast', function(){
                $(this).parent().find('.username').focus();
            });
            return false;
        }
        if(password == '' || password.length <5 ) {
            $('.page-container').find('.error').fadeOut('fast', function(){
                $(this).css('top', '96px');
            });
            $('.page-container').find('.error').fadeIn('fast', function(){
                $(this).parent().find('.password').focus();
            });
            return false;
        }
        if(captcha == '' || captcha.length != 5 ) {
            $('.page-container').find('.error').fadeOut('fast', function(){
                $(this).css('top', '166px');
            });
            $('.page-container').find('.error').fadeIn('fast', function(){
                $(this).parent().find('.captcha').focus();
            });
            return false;
        }
        $.post(src,{username:username,password:password,captcha:captcha,_token:token},function (msg) {
            if(msg.status < 0){
                $('.msg').html();
                $('.msg').html(msg.msg);
                $('#captcha').click();
            }else{
                //TODO
                location.href = admin_index;
            }
        })

    });

    $('.page-container form .username, .page-container form .password, .page-container form img').keyup(function(){
        $(this).parent().find('.error').fadeOut('fast');
    });

});
