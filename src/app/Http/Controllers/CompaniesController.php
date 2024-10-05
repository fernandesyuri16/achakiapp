<?php

namespace App\Http\Controllers;

use App\Helpers\Http;
use App\Http\Requests\Companies\StoreCompaniesRequest;
use App\Http\Requests\Companies\UpdateCompaniesRequest;
use App\Services\CompaniesService;
use Illuminate\Http\JsonResponse;

class CompaniesController extends Controller
{
    use Http;

    /**
     * @var CompaniesService Companies service
     */
    private CompaniesService $service;

    public function __construct(CompaniesService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        try {
            $data = $this->service->getCompanies();

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function store(StoreCompaniesRequest $request): JsonResponse
    {
        try {
            $data = $this->service->createCompany($request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function show(int $companyId): JsonResponse
    {
        try {
            $data = $this->service->getCompanyById($companyId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function update(int $companyId, UpdateCompaniesRequest $request): JsonResponse
    {
        try {
            $data = $this->service->updateCompany($companyId, $request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function destroy(int $companyId): JsonResponse
    {
        try {
            $data = $this->service->deleteCompany($companyId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }
}
