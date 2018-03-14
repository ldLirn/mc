<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

/**
 * Class AdminEditRequest
 * @package App\Http\Requests
 * 修改管理员验证规则
 */
class PowerEditRequest extends Request
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
            'email'=>'required|email|unique:users,email,'.$this->get('id'),
            'role_id'=>'required'
        ];
    }

    public function messages()
    {
        return[
            'email.required'=>'邮箱不能为空!',
            'email.unique'=>'邮箱已经存在!',
            'email.email'=>'邮箱格式不正确!',
            'role_id.required'=>'请选择角色'
        ];
    }
}
