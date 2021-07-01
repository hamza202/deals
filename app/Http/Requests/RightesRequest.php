<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RightesRequest extends FormRequest
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
            'title' => "required_without:id|string",
            'content1' => "required_without:id|max:450",
            'photo' => "required_without:id|mimes:jpg,jpeg,png|nullable",
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'string' => 'هذا الحقل لابد ان يكون احرف ',
            'max' => 'اقصي عدد للحروف 450',
            'mimes' => 'صيغة الصورة غير مقبولة ',
        ];
    }
}

