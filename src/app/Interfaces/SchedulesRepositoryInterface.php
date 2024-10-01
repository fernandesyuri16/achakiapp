<?php

namespace App\Interfaces;

interface SchedulesRepositoryInterface
{
    public function createSchedule(array $scheduleDetails);
    public function getScheduleById(int $scheduleId);
    public function getSchedules();
    public function updateSchedule(int $scheduleId, array $scheduleDetails);
    public function deleteSchedule(int $scheduleId);
}
