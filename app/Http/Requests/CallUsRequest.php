<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CallUsRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required|string|max:100',
            'title' => 'required|string|max:100',
            'whatsapp' => 'required',
            'message' => 'required',


        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'email.email' => 'ادخل عنوان بريد إلكتروني صالح.',
            'string' => 'هذا الحقل لابد ان يكون احرف ',
            'max' => 'هذا الحقل لابد الا يزيد عن 100 احرف ',

        ];
    }
}
