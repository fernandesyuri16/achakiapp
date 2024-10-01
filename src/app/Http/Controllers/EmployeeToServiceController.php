<?php

namespace App\Http\Controllers;

use App\Helpers\Http;
use App\Http\Requests\Employees\StoreEmployeesToServiceRequest;
use App\Http\Requests\Employees\UpdateEmployeesToServiceRequest;
use App\Services\EmployeeToServiceService;
use Illuminate\Http\JsonResponse;

class EmployeeToServiceController extends Controller
{
    use Http;

    /**
     * @var EmployeeToServiceService Employees service
     */
    private EmployeeToServiceService $service;

    public function __construct(EmployeeToServiceService $service)
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

    public function store(StoreEmployeesToServiceRequest $request): JsonResponse
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

    public function update(int $employeeId, UpdateEmployeesToServiceRequest $request): JsonResponse
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
