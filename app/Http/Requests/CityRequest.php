<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            'name' => 'required|string|max:100|unique:cities,name',
        ];
    }


    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'name.string' => 'اسم المدينة لابد ان يكون احرف',
            'name.max' => 'اسم المدينة لابد الا يزيد عن 100 احرف ',
            'name.unique' => 'المدينة مضافة من قبل',
        ];
    }
}
