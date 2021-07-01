<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'description' => "nullable|string",
            'photo' => "required|mimes:jpg,jpeg,png",

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
