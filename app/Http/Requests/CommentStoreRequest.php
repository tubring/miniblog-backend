<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
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
            // 'article_id' => 'required',
            'content' => 'required|min:5',
            'captcha' => 'required|captcha',
        ];
    }

    public function messages(){

        return [
            'content.required' => '[评论内容] 不能为空',
            'content.min' => '[评论内容] 不能少于5个字符',
            'captcha.required' => '[验证码] 不能为空',
            'captcha.captcha' => '[验证码] 错误',
        ];
    }
}
