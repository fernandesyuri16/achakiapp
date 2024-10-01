<?php

namespace App\Services;

use App\Helpers\Http;
use App\Repositories\SchedulesRepository;

class SchedulesService
{
    use Http;

    private SchedulesRepository $repository;

    public function __construct()
    {
        $this->repository = new SchedulesRepository;
    }

    /**
     * Create a new schedule.
     *
     * @param array $scheduleDetails - Details of the schedule.
     * @return array - Returns an array with the created schedule or an error message.
     */
    public function createSchedule(array $scheduleDetails): array
    {
        $scheduleDetails['user_id'] = auth()->user()->id;

        $schedule = $this->repository->createSchedule($scheduleDetails);

        return $this->created($schedule);
    }

    /**
     * Get a specific schedule.
     *
     * @param int $scheduleId - The ID of the schedule.
     * @return array - Returns an array with the schedule or an error message.
     */
    public function getScheduleById(int $scheduleId): array
    {
        $error = $this->checkIfHasError($scheduleId);

        if (! empty($error)) {
            return $error;
        }

        $schedule = $this->repository->getScheduleById($scheduleId);

        return $this->ok($schedule);
    }

    /**
     * Get all schedule.
     *
     * @return array - Returns an array with all schedule.
     */
    public function getSchedules(): array
    {
        $schedules = $this->repository->getSchedules();

        return $this->ok($schedules->items());
    }

    /**
     * Check if there are any errors.
     *
     * @param int $scheduleId - The ID of the scheduling.
     * @param bool $checkPermission - Whether to check for permissions.
     * @return array - Returns an array with an error message if there are any errors.
     */
    private function checkIfHasError(int $scheduleId, bool $checkPermission = false): array
    {
        $scheduleDetails = $this->repository->getScheduleById($scheduleId);

        if (! $this->scheduleExists($scheduleId)) {
            return $this->notFound("Schedule doesn't exists.");
        }

        if ($checkPermission && $scheduleDetails['user_id'] !== auth()->user()->id) {
            return $this->forbidden("You don't have permission to perform this action.");
        }

        return [];
    }

    /**
     * Check if a schedule exists.
     *
     * @param int $scheduleId - The ID of the schedule .
     * @return bool - Returns true if the schedule exists, false otherwise.
     */
    private function scheduleExists(int $scheduleId): bool
    {
        $schedule = $this->repository->getScheduleById($scheduleId);

        if (empty($schedule->id)) {
            return false;
        }

        return true;
    }

    /**
     * Update a specific schedule.
     *
     * @param int $scheduleId - The ID of the schedule.
     * @param array $scheduleDetails - The new details of the schedule.
     * @return array - Returns an array with the updated schedule or an error message.
     */
    public function updateSchedule(int $scheduleId, array $scheduleDetails): array
    {
        $error = $this->checkIfHasError($scheduleId, true);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->updateSchedule($scheduleId, $scheduleDetails);

        $schedule = $this->repository->getScheduleById($scheduleId);

        return $this->ok($schedule);
    }

    /**
     * Delete a specific schedule.
     *
     * @param int $scheduleId - The ID of the schedule.
     * @return array - Returns an array with a success message or an error message.
     */
    public function deleteSchedule(int $scheduleId): array
    {
        $error = $this->checkIfHasError($scheduleId, true);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->deleteSchedule($scheduleId);

        return $this->ok('Schedule successfully deleted!');
    }
}
