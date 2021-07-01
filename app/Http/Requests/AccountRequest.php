<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'username' => "required|string",
            'name' => "required|string",
            'email' => "required|string|email|max:191|unique:advertisers,email,".$this -> id,
            'phone' => "required|unique:advertisers,phone,".$this -> id,
            'city_id' => "required",


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

        ];
    }
}
