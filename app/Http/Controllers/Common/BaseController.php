<?php

namespace App\Http\Controllers\Common;
use App\Http\Controllers\Controller;

/**
 * Class BaseController
 * @package App\Http\Controllers\Common
 * 基础类
 */
class BaseController extends Controller
{
    public function __construct()
    {
        if(config('web.web_status') == 0){
            abort('503','网站正在维护中！');
        }
    }
}
