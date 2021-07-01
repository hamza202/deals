<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GiftRequest extends FormRequest
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
           'name' => "required_without:id|string",
           'points' => "required_without:id",
           'membership_id' => "required_without:id",
           'photo' => "required_without:id|mimes:jpg,jpeg,png|nullable",
           'available' => "required_without:id|nullable",
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'string' => 'هذا الحقل لابد ان يكون احرف ',
            'max' => 'هذا الحقل لابد الا يزيد عن 191 احرف ',
            'min' => 'هذا الحقل لابد الا يقل عن 6 احرف ',
            'unique' => 'مستخدم من قبل ',
            'mimes' => 'صيغة الصورة غير مقبولة ',
        ];
    }
}
