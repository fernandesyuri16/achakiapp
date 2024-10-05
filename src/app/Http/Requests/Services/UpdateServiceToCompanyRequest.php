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
            'service_id' => 'sometimes|required',
            'company_id' => 'sometimes|required',
            'cost' => 'sometimes|required',
        ];
    }
}
