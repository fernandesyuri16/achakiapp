<?php

namespace App\Http\Controllers;

use App\Helpers\Http;
use App\Http\Requests\Services\StoreServicesRequest;
use App\Http\Requests\Services\UpdateServicesRequest;
use App\Services\ServicesService;
use Illuminate\Http\JsonResponse;

class ServicesController extends Controller
{
    use Http;

    /**
     * @var ServicesService Services service
     */
    private ServicesService $service;

    public function __construct(ServicesService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        try {
            $data = $this->service->getServices();

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function store(StoreServicesRequest $request): JsonResponse
    {
        try {
            $data = $this->service->createService($request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function show(int $serviceId): JsonResponse
    {
        try {
            $data = $this->service->getServiceById($serviceId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function update(int $serviceId, UpdateServicesRequest $request): JsonResponse
    {
        try {
            $data = $this->service->updateService($serviceId, $request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function destroy(int $serviceId): JsonResponse
    {
        try {
            $data = $this->service->deleteService($serviceId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }
}
