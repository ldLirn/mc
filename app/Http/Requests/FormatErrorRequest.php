<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class FormatErrorRequest extends FormRequest
{
    /**
     * Throws an exception information for a form filling data
     * @param Validator $validator
     * @Throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {

        throw new ValidationException($validator,$this->response(
            $this->formatErrors($validator)));
    }

    /**
     * Package error information
     * @param Validator $validator
     * @Return array
     */
    protected function formatErrors(Validator $validator)
    {
        $message = $validator->errors()->all();
        $result = [
            'msg' => $message,
            'status' => 0
        ];
        return $result;
    }
}
