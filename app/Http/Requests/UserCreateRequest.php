<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

/**
 * Class UserCreateRequest
 * @package App\Http\Requests
 * 会员 添加 规则
 */
class UserCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|alpha_num|unique:users,name',
            'email'=>'required|email|unique:users,email',
            'telphone'=>'required|unique:users,telphone|regex:/^1[34578]\d{9}$/',
            'qq'=>'required|unique:users,qq|regex:/^[1-9]\d{4,13}$/',
            'password'=>'required|alpha_num|between:6,12',
        ];
    }

    public function messages()
    {
        return[
            'name.required'=>'会员名称不能为空!',
            'name.alpha_num'=>'会员名称只能是数字字母!',
            'name.unique'=>'会员名称已经存在!',
            'email.required'=>'邮箱不能为空!',
            'email.email'=>'邮箱不正确!',
            'email.unique'=>'邮箱已经存在!',
            'telphone.unique'=>'手机号码已经存在',
            'telphone.regex'=>'手机号码格式不正确',
            'telphone.required'=>'手机号码不能为空',
            'qq.required'=>'QQ不能为空!',
            'qq.regex'=>'QQ格式不正确!',
            'qq.unique'=>'QQ已经存在!',
            'password.required'=>'密码不能为空!',
            'password.between'=>'密码应该是6到12位!',
        ];
    }
}
