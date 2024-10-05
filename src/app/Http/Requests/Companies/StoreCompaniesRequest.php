<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompaniesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'latitude' => 'required',
            'longitude' => 'required',
            'phone' => 'required',
            'social_link' => 'required',
        ];
    }
}
