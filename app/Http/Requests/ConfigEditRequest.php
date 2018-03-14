<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

/**
 * Class ConfigEditRequest
 * @package App\Http\Requests
 * 网站配置 修改 规则
 */
class ConfigEditRequest extends Request
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
            'config_title'=>'required|unique:config,config_title,'.$this->get('id'),
            'config_name'=>'required|alpha_dash|unique:config,config_name,'.$this->get('id'),
            'field_type'=>'required',
        ];
    }

    public function messages()
    {
        return[
            'config_title.required'=>'配置名称不能为空!',
            'config_name.required'=>'英文别名不能为空!',
            'config_title.unique'=>'配置名称已经存在!',
            'config_name.unique'=>'变量名称已经存在!',
            'config_name.alpha'=>'别名只能是字母和数字，以及破折号和下划线!',
            'field_type.required'=>'类型不能为空!',
        ];
    }
}
