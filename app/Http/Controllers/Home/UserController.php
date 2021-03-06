<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\NavModel;
use App\Http\Model\User;
use Illuminate\Support\Facades\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Zhuzhichao\IpLocationZh\Ip;

class UserController extends Controller
{
    public function index()
    {
        $address = Ip::find(Request::getClientIp());  //获取用户地理位置
        $nav_data = (new NavModel())->getNav();
        return view('home.user',compact('nav_data','address'));
    }
    
    //个人资料
    public function data()
    {
        $address = Ip::find(Request::getClientIp());  //获取用户地理位置
        $nav_data = (new NavModel())->getNav();
        $data = session('users');
        return view('home.data',compact('data','nav_data','address'));
    }
}
