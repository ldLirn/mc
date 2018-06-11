<?php

namespace App\Http\Controllers\Auth;

use App\Http\Model\MailLog;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Germey\Geetest\GeetestCaptcha;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins {
        AuthenticatesAndRegistersUsers::postLogin as laravelPostLogin;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    //protected $redirectTo = '/';
    protected $username = 'login';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function showLoginForm(Request $request){
        if (!empty($request->get('redirectUrl'))) { // 如果有跳转地址的话
            session(['url.intended' => $request->get('redirectUrl')]);
        }
        return view("home.login");
    }

    //重写登录方法
    public function login(Request $request)
    {
        $this->validateLogin($request);
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        $credentials = $this->getCredentials($request);
        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }


    public function showRegistrationForm(Request $request)
    {
        if (!empty($request->get('redirectUrl'))) { // 如果有跳转地址的话
            session(['url.intended' => $request->get('redirectUrl')]);
        }
        return view("home.register");
    }


    // 增加方法  判断用户名类型
    protected function getCredentials(Request $request)
    {
        $login = $request->get('login');
        // $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        if(filter_var($login, FILTER_VALIDATE_EMAIL)){
            $field = 'email';
        }elseif (preg_match("/^1[34578]{1}\d{9}$/", $login)){
            $field = 'telphone';
        }else{
            $field = 'username';
        }
        return [
            $field => $login,
            'password' => $request->get('password'),
        ];
    }


    /**
     *  发送注册邮件
     */
    public function send_register_email(Request $request)
    {
       $email = $request->get('email');

        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            return back()->with('msg','邮箱地址不正确！');
        }
        //记录验证编码
        $activationcode = md5($email.time());  //生成邮箱验证时的随机串
        $data['activationcode'] = $activationcode;
        $data['email'] = $email;
        //发送邮件
        if(Mail::send('activemail', $data, function($message) use($data,$activationcode,$email)
        {
            //dd($email);
            $message->to($data['email'])->subject('欢迎注册，请点击链接继续注册！');
            $mail_log = new MailLog();
            $mail_log->email = $email;
            $mail_log->activationcode = $activationcode;
            $mail_log->create_time = time();
            if($mail_log->where('email', $email)->first()){
                $mail_log->where('email', $email)->update(['activationcode'=>$activationcode]);
            }else{
                $mail_log->save();
            }
        })) {
            return back()->with('msg','发送成功,请点击邮件中链接继续操作');
        }else{
            return back()->with('msg','系统开小差了，请稍后重试');
        }
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 自定义注册
     */
    public function postRegister(Request $request)
    {
        $rules = [
            'name'=>'required|unique:users,name',
            'password' => 'required|between:6,20|confirmed',
            'email' =>'required|email|unique:users,email'
        ];
        $messages = [
            'required'=>':attribute不能为空',
            'name.unique'=>'用户名已被注册',
            'email.unique'=>'邮箱已被注册',
            'email.email'=>'邮箱地址错误',
            'password.between' => '密码必须是6~20位之间',
            'password.confirmed' => '密码和确认密码不匹配',

        ];
        $username = $request->input('name');
        $password = $request->input('password');
        $email = $request->input('email');
        $data = $request->all();
        $validator = \Illuminate\Support\Facades\Validator::make($data, $rules, $messages);
        $last_ip = $request->getClientIp();
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $user = new User();
        $user->email = $email;
        $user->name = $username;
        $user->password = bcrypt($password);
        $user->last_login = time();
        $user->last_ip = $last_ip;
        $user->reg_time = time();
        if($user->save()){
            return redirect('auth/register_success?m='.$this->newbase64_en($email).'&n='.$this->newbase64_en($username));
        }else{
            return back()->with('msg','系统开小差了，请稍后重试');
        }
        //User::create($data); //插入一条新纪录，并返回保存后的模型实例
        //如果注册后还想立即登录的话，可以使用$user = User::create($data); Auth::login($user); 进行认证

    }


}
