<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NavCreateRequest extends Request
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
            'nav_name'=>'required|unique:nav,nav_name',
            'nav_order'=>'required',
            'nav_url'=>'required',
            'nav_wz'=>'required'
        ];
    }


    public function messages()
    {
        return[
            'nav_name.required'=>'导航名不能为空!',
            'nav_name.unique'=>'导航名已经存在!',
            'nav_order.required'=>'排序不能为空!',
            'nav_url.required'=>'链接地址不能为空!',
            'nav_wz.required'=>'导航位置必选！'
        ];
    }
}
