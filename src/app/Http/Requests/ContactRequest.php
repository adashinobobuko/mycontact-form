<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true; // 認証不要の場合はtrueに設定
    }

    public function rules()
    {
        return [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'email' => 'required|email',
            'tel1' => 'required|numeric|digits_between:2,4',
            'tel2' => 'required|numeric|digits_between:2,4',
            'tel3' => 'required|numeric|digits_between:2,4',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
            'type' => 'required|in:general,support,feedback',
            'message' => 'required|string|max:120',
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            //'email.email' => '有効なメールアドレスを入力してください',
            'tel1.required' => '電話番号を入力してください',
            'tel1.numeric' => '電話番号は数字で入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel2.numeric' => '電話番号は数字で入力してください',
            'tel3.required' => '電話番号を入力してください',
            'tel3.numeric' => '電話番号は数字で入力してください',
            'address.required' => '住所を入力してください',
            'type.required' => 'お問い合わせの種類を選択してください',
            'message.required' => 'お問い合わせ内容を入力してください',
        ];
    }
}
