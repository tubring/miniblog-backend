<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
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
            'content' => 'required|min:5',
            'name' => 'required',
            'captcha'=>'required|captcha',
        ];
    }


    public function messages(){
        return [
            "name.required" => "[昵称] 不能为空!",
            "content.required" => "[留言内容] 不能为空!",
            "content.min" => "[留言内容] 不应少于5个字符!",
            'captcha.required'=>"[验证码] 不能为空!",
            'captcha.captcha'=>"[验证码] 错误!",
        ];
    }
}
