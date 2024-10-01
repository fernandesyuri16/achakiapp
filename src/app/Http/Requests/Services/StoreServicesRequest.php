<?php

namespace App\Http\Requests\Services;

use Illuminate\Foundation\Http\FormRequest;

class StoreServicesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'description' => 'required',
        ];
    }
}
