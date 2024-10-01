<?php

namespace App\Http\Controllers;

use App\Helpers\Http;
use App\Http\Requests\Schedules\StoreSchedulesRequest;
use App\Http\Requests\Schedules\UpdateSchedulesRequest;
use App\Services\SchedulesService;
use Illuminate\Http\JsonResponse;

class SchedulesController extends Controller
{
    use Http;

    /**
     * @var SchedulesService Schedules service
     */
    private SchedulesService $service;

    public function __construct(SchedulesService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        try {
            $data = $this->service->getSchedules();

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function store(StoreSchedulesRequest $request): JsonResponse
    {
        try {
            $data = $this->service->createSchedule($request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function show(int $scheduleId): JsonResponse
    {
        try {
            $data = $this->service->getScheduleById($scheduleId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function update(int $scheduleId, UpdateSchedulesRequest $request): JsonResponse
    {
        try {
            $data = $this->service->updateSchedule($scheduleId, $request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function destroy(int $scheduleId): JsonResponse
    {
        try {
            $data = $this->service->deleteSchedule($scheduleId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }
}
