<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MembershipRequest extends FormRequest
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
            'title' => "required_without:id|string",
            'photo' => "required_without:id|mimes:jpg,jpeg,png,svg|nullable",
            'qualifications' => "required_without:id",
            'features' => 'required_without:id',

          ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'string' => 'هذا الحقل لابد ان يكون احرف ',
             ];
    }

}
