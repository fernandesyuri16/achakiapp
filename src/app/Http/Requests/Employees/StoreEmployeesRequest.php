<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'company_id' => 'required',
        ];
    }
}
