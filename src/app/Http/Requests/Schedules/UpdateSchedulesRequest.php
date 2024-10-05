<?php

namespace App\Http\Requests\Schedules;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSchedulesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|required',
            'service_id' => 'sometimes|required',
            'employee_id' => 'sometimes|required',
            'schedule_date' => 'sometimes|required|unique:schedules|date_format:Y-m-d H:i:s',
        ];
    }
}
