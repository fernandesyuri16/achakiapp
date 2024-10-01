<?php

namespace App\Http\Controllers;

use App\Helpers\Http;
use App\Http\Requests\Services\StoreServiceToCompanyRequest;
use App\Http\Requests\Services\UpdateServiceToCompanyRequest;
use App\Services\ServiceToCompanyService;
use Illuminate\Http\JsonResponse;

class ServiceToCompanyController extends Controller
{
    use Http;

    /**
     * @var ServiceToCompanyService Services service
     */
    private ServiceToCompanyService $service;

    public function __construct(ServiceToCompanyService $service)
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

    public function store(StoreServiceToCompanyRequest $request): JsonResponse
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

    public function update(int $serviceId, UpdateServiceToCompanyRequest $request): JsonResponse
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
