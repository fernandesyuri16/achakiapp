<?php

namespace App\Repositories;

use App\Interfaces\SchedulesRepositoryInterface;
use App\Models\Schedules;
use Illuminate\Pagination\Paginator;

class SchedulesRepository implements SchedulesRepositoryInterface
{
    public function createSchedule(array $scheduleDetails): Schedules
    {
        return Schedules::create($scheduleDetails);
    }

    public function getScheduleById(int $scheduleId): ?Schedules
    {
        return Schedules::find($scheduleId);
    }

    public function getSchedules(): Paginator
    {
        return Schedules::simplePaginate(10);
    }

    public function updateSchedule(int $scheduleId, array $scheduleDetails): void
    {
        Schedules::whereId($scheduleId)->update($scheduleDetails);
    }

    public function deleteSchedule(int $scheduleId): void
    {
        Schedules::destroy($scheduleId);
    }
}