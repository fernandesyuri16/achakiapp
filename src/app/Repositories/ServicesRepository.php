<?php

namespace App\Repositories;

use App\Interfaces\ServicesRepositoryInterface;
use App\Models\Services;
use Illuminate\Pagination\Paginator;

class ServicesRepository implements ServicesRepositoryInterface
{
    public function createService(array $serviceDetails): Services
    {
        return Services::create($serviceDetails);
    }

    public function getServiceById(int $serviceId): ?Services
    {
        return Services::find($serviceId);
    }

    public function getServices(): Paginator
    {
        return Services::simplePaginate(20);
    }

    public function updateService(int $serviceId, array $serviceDetails): void
    {
        Services::whereId($serviceId)->update($serviceDetails);
    }

    public function deleteService(int $serviceId): void
    {
        Services::destroy($serviceId);
    }
}