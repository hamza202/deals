<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'content1' => 'max:450',
        ];
    }

    public function messages()
    {
        return [
            'max' => 'هذا الحقل لابد الا يزيد عن 450 احرف ',
        ];
    }
}
