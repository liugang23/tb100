<?php

namespace App\Http\Home\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 检查认证用户是否有资格更新指定资源
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     * 获取应用到请求的验证规则
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => 'required',
            'passw' => 'required',
            'captcha' => 'required|captcha'
        ];
    }

    /**
     * 自定义错误消息
     * @return array 
     */
    public function messages()
    {
        return [
            'phone.required' => '请填写登录帐号',
            'passw.required' => '请填写登录密码',
            'captcha.required' => '请填写验证码',
            'captcha.captcha' => '请填写正确的验证码'
        ];
    }
}
