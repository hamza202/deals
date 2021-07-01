<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertiserRequest extends FormRequest
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

    public function rules()
    {
        return [
            'g-recaptcha-response' => 'required',
            'username' => "required_without:id|string|unique:advertisers,username," . $this->id,
            'name' => "required_without:id|string",
            'password' => 'min:6|required_without:id|confirmed',
            'password_confirmation' => 'min:6 |required_without:id',
            'city_id' => "required_without:id",
            'email' => "required_without:id|string|email|max:191|unique:advertisers,email," . $this->id,
            'phone' => "required_without:id|unique:advertisers,phone," . $this->id,
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'email.email' => 'ادخل عنوان بريد إلكتروني صالح.',
            'string' => 'هذا الحقل لابد ان يكون احرف ',
            'max' => 'هذا الحقل لابد الا يزيد عن 191 احرف ',
            'min' => 'هذا الحقل لابد الا يقل عن 6 احرف ',
            'confirmed' => 'كلمة المرور غير متطابقة ',
            'unique' => 'مستخدم من قبل ',
            'g-recaptcha-response.required' => 'Please complete the captcha',
        ];
    }

}
