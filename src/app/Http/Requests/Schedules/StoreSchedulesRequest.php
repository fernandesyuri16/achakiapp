<?php

namespace App\Http\Requests\Schedules;

use Illuminate\Foundation\Http\FormRequest;

class StoreSchedulesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required',
            'service_id' => 'required',
            'employee_id' => 'required',
            'schedule_date' => 'required|unique:schedules|date_format:Y-m-d H:i:s',
        ];
    }
}
