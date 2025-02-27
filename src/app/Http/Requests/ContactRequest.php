<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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

            // 姓（last_name）と名（first_name）は必須
            'last_name'  => 'required|string|max:255',
            'first_name' => 'required|string|max:255',

            // 性別は必須（1,2,3のいずれか）
            'gender'     => 'required|in:1,2,3',

            // メールアドレスは必須かつメール形式、usersテーブル内でユニークであれば必要に応じて追加
            'email'      => 'required|email',

            // 電話番号（phone1, phone2, phone3）は必須、半角数字のみ、5桁まで
            'phone1'     => ['required', 'regex:/^\d{1,3}$/'],
            'phone2'     => ['required', 'regex:/^\d{1,4}$/'],
            'phone3'     => ['required', 'regex:/^\d{1,4}$/'],

            // 住所は必須
            'address'    => 'required|string|max:255',

            // 建物名は任意（nullable）
            'building'   => 'nullable|string|max:255',

            // お問い合わせの種類は必須
            'content'    => 'required',

            // お問い合わせ内容は必須、120文字以内
            'detail'     => 'required|string|max:120',

        ];
    }

    public function messages()
    {
        return [
            // 姓・名
            'last_name.required'  => '姓を入力してください',
            'first_name.required' => '名を入力してください',

            // 性別
            'gender.required'     => '性別を選択してください',
            'gender.in'           => '性別を選択してください',

            // メールアドレス
            'email.required'      => 'メールアドレスを入力してください',
            'email.email'         => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',

            // 電話番号
            'phone1.required'     => '電話番号を入力してください',
            'phone1.regex'        => '電話番号は3桁までの数字で入力してください',
            'phone2.required'     => '電話番号を入力してください',
            'phone2.regex'        => '電話番号は4桁までの数字で入力してください',
            'phone3.required'     => '電話番号を入力してください',
            'phone3.regex'        => '電話番号は4桁までの数字で入力してください',

            // 住所
            'address.required'    => '住所を入力してください',

            // お問い合わせの種類
            'content.required'    => 'お問い合わせの種類を選択してください',

            // お問い合わせ内容
            'detail.required'     => 'お問い合わせ内容を入力してください',
            'detail.max'          => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
