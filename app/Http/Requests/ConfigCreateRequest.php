<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

/**
 * Class ConfigCreateRequest
 * @package App\Http\Requests
 * 网站配置 添加 规则
 */
class ConfigCreateRequest extends Request
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
            'config_title'=>'required|unique:config,config_title',
            'config_name'=>'required|alpha_dash|unique:config,config_name',
            'field_type'=>'required',
        ];
    }

    public function messages()
    {
        return[
            'config_title.required'=>'配置名称不能为空!',
            'config_title.unique'=>'配置名称已经存在!',
            'config_name.required'=>'变量名称不能为空!',
            'config_name.unique'=>'变量名称已经存在!',
            'config_name.alpha'=>'变量名称只能是字母和数字，以及破折号和下划线!',
            'field_type.required'=>'类型不能为空!',
        ];
    }
}
