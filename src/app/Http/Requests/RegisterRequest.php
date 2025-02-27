<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        // バリデーションルールを定義
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ];
    }

    // カスタムエラーメッセージを定義
    public function messages()
    {
        return [
            'name.required'     => 'お名前を入力してください',
            'email.required'    => 'メールアドレスを入力してください',
            'email.email'       => 'メールアドレスは「〇〇@ドメイン」形式で入力してください',
            'password.required' => 'パスワードを入力してください',
        ];
    }

    protected function getRedirectUrl()
    {
        // エラー発生時、登録フォームに戻す例
        return url('/auth/register');
    }
}
