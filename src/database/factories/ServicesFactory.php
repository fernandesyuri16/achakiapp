<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Services>
 */
class ServicesFactory extends Factory
{
    public function definition(): array
   {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(255),
            'user_id' => fake()->randomNumber(2)
        ];
    }
}
