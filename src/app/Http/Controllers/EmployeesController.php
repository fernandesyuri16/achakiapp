<?php

namespace App\Http\Controllers;

use App\Helpers\Http;
use App\Http\Requests\Employees\StoreEmployeesRequest;
use App\Http\Requests\Employees\UpdateEmployeesRequest;
use App\Services\EmployeesService;
use Illuminate\Http\JsonResponse;

class EmployeesController extends Controller
{
    use Http;

    /**
     * @var EmployeesService Employees service
     */
    private EmployeesService $service;

    public function __construct(EmployeesService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        try {
            $data = $this->service->getEmployees();

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function store(StoreEmployeesRequest $request): JsonResponse
    {
        try {
            $data = $this->service->createEmployee($request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function show(int $employeeId): JsonResponse
    {
        try {
            $data = $this->service->getEmployeeById($employeeId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function update(int $employeeId, UpdateEmployeesRequest $request): JsonResponse
    {
        try {
            $data = $this->service->updateEmployee($employeeId, $request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function destroy(int $employeeId): JsonResponse
    {
        try {
            $data = $this->service->deleteEmployee($employeeId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }
}
