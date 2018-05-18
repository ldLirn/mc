<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MenuEditRequest extends Request
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
            'title'=>'required|unique:menu,title,'.$this->get('id'),
            'order'=>'required',
            'pid'=>'required',
        ];
    }


    public function messages()
    {
        return[
            'title.required'=>'菜单名不能为空!',
            'title.unique'=>'菜单名已经存在!',
            'order.required'=>'排序不能为空!',
            'pid.required'=>'链接地址不能为空!',
        ];
    }
}
