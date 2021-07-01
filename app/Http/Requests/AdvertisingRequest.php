<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisingRequest extends FormRequest
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
            'title' => "required|string",
            'city_id' => "required",
            'price' => "required",
            'category' => 'required',
            'phone' => "required",
            'address' => "required",
            'description' => "required",
            'start_date' => "required",
            'end_date' => "required",
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
