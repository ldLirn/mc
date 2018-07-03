<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Model\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }





    /**
     * 重置密码操作
     */
    public function resetPassword()
    {
        $input = Input::all();
        if($input['password'] != $input['password_confirmation']){
            return back()->with('msg','两次输入的密码不一致');
        }
        $phone = session('phone') ? session('phone') : '';  //通过手机重置密码
        $email = session('email') ? session('email') : '';  //通过邮箱重置密码
        if($email != $input['email']){
            return back()->with('msg','邮箱验证不通过');
        }
        $password = bcrypt($input['password']);
        if($phone){
            $msg = User::where('telphone',$phone)->update(['password'=>$password]);
            if($msg){
                Session::pull('phone','');
                return back()->with('msg','密码重置成功');
            }else{
                return back()->with('msg','系统错误，请重试');
            }
        }
        if($email){
            $msg = User::where('email',$email)->update(['password'=>$password]);
            if($msg){
                Session::pull('email','');
                return back()->with('msg','密码重置成功');
            }else{
                return back()->with('msg','系统错误，请重试');
            }
        }
    }
}
