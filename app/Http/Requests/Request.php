<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

abstract class Request extends FormRequest
{
    /**
     * @param array $errors
     * @return $this|JsonResponse
     * 重写表单错误返回信息
     */
    public function response(array $errors)
    {
        foreach ($errors as $v){
            foreach ($v  as $n => $m)
                $err['status'] = 422;
                $err['msg'] = $m;
        }

        if (($this->ajax() && ! $this->pjax()) || $this->wantsJson()) {
            return new JsonResponse($err, 200);
        }

        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }
}
