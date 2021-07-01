<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
            'address' => 'required|string|max:100',
            'abuse_type' => 'required|string|max:100',
            'comment' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'string' => 'هذا الحقل لابد ان يكون احرف ',
            'max' => 'هذا الحقل لابد الا يزيد عن 100 احرف ',
        ];
    }
}
