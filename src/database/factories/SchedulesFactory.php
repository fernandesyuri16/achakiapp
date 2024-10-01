<?php

namespace Database\Factories;

use App\Models\Employees;
use App\Models\Services;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedules>
 */
class SchedulesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'service_id' => Services::factory(),
            'employee_id' => Employees::factory(),
            'schedule_date' => fake()->dateTimeBetween('now', '+1 day'),
        ];
    }
}
