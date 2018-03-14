<?php
/**
 * Created by PhpStorm.
 * User: lirn
 * Date: 2017/12/14
 * Time: 14:20
 * desc: 扩展函数库
 */


/**
 *  解析jsonp数据
 */
if( ! function_exists('jsonp_decode')){
    function jsonp_decode($jsonp, $assoc = false) { // PHP 5.3 adds depth as third parameter to json_decode
        if($jsonp[0] !== '[' && $jsonp[0] !== '{') { // we have JSONP
            $jsonp = substr($jsonp, strpos($jsonp, '('));
        }
        return json_decode(trim($jsonp,'();'), $assoc);
    }
}


/**
 *  base64  图片转换成图片 保存到本地
 */
if( ! function_exists('base64_img')){
    function base64_img($base_img,$prefix = '') {
        //  $base_img是获取到前端传递的src里面的值，也就是我们的数据流文件
            $base_img = str_replace('data:image/jpeg;base64,', '', $base_img);
            $path = base_path()."/public/uploads/";
            $newName = $prefix.date('ymd');
            $path = $path.$newName;
            if (!is_dir($path)){ //判断目录是否存在 不存在就创建
                mkdir($path,0777,true);
            }
            $pic_name = $newName.rand(1111,9999).'.jpg';
            $new_pic = $path.'/'.$pic_name;
            file_put_contents($new_pic, base64_decode($base_img));
            $return_img = "/uploads/".$newName.'/'.$pic_name;
            \Illuminate\Support\Facades\Log::info(session('users.username').'上传图片'.$return_img);
            return $return_img;
    }
}