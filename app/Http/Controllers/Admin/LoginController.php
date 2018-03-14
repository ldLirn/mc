<?php

namespace App\Http\Controllers\Admin;

use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        if (Request::getMethod() == 'POST'){
            $data = Input::all();
            $rules = ['captcha' => 'required|captcha'];
            $validator = Validator::make($data, $rules);
            if ($validator->fails())
            {
                return response()->json(array(
                    'status' => -1,
                    'msg' => '验证码错误！',
                ));
            }
            if($data['username']==''){
                return response()->json(array(
                    'status' => -2,
                    'msg' => '用户名不能为空！',
                ));
            }
            if($data['password']==''){
                return response()->json(array(
                    'status' => -3,
                    'msg' => '密码不能为空！',
                ));
            }
            $have = User::where('name',$data['username'])->first();  //查询有没此用户
            if(!$have){
                return response()->json(array(
                    'status' => -4,
                    'msg' => '用户名不存在！',
                ));
            }else{
                if($have['is_admin']=='0'){
                    return response()->json(array(
                        'status' => -5,
                        'msg' => '对不起，您无权登录！',
                    ));
                }
                if($data['username'] == $have->name && decrypt($have->password) == $data['password']){
                    $data['password'] = '';
                    session(['users'=>$data]);
                    Cache::forget('menu');
                    Log::info($data['username'].'登录');
                    $this->log_login($have->id);
                    return response()->json(array(
                        'status' => 200,
                        'msg' => '',
                    ));
                }else{
                    return response()->json(array(
                        'status' => -6,
                        'msg' => '用户名或密码错误',
                    ));
                }
            }
        }else{
            return response()->json(array(
                'status' => -200,
                'msg' => '非法请求!',
            ));
        }
    }

    public function out()
    {
        session(['users'=>null]);
        return redirect('admin/login');
    }

    private function log_login($id){
        $data['last_login'] = time();
        $data['last_ip'] = Request::getClientIp();
        User::where('id',$id)->update($data);
    }
}
