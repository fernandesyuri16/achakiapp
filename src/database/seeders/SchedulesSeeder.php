<?php

namespace Database\Seeders;

use App\Models\Schedules;
use Illuminate\Database\Seeder;

class SchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedules::factory(10)->create();
    }
}
