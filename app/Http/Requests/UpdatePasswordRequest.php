<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'old_password'     => 'required',
            'password' => 'min:6|required|confirmed',
            'password_confirmation' => 'min:6 |required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'min' => 'هذا الحقل لابد الا يقل عن 6 احرف ',
            'confirmed' => 'كلمة المرور غير متطابقة ',

                 ];
    }
}
