<?php

namespace App\Http\Requests\Services;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceToCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'service_id' => 'required',
            'company_id' => 'required',
            'cost' => 'required',
        ];
    }
}
