<?php

namespace App\Repositories;

use App\Interfaces\ServiceToCompanyRepositoryInterface;
use App\Models\ServiceToCompany;
use Illuminate\Pagination\Paginator;

class ServiceToCompanyRepository implements ServiceToCompanyRepositoryInterface
{
    public function createService(array $serviceDetails): ServiceToCompany
    {
        return ServiceToCompany::create($serviceDetails);
    }

    public function getServiceById(int $serviceId): ?ServiceToCompany
    {
        return ServiceToCompany::find($serviceId);
    }

    public function getServices(): Paginator
    {
        return ServiceToCompany::simplePaginate(10);
    }

    public function updateService(int $serviceId, array $serviceDetails): void
    {
        ServiceToCompany::whereId($serviceId)->update($serviceDetails);
    }

    public function deleteService(int $serviceId): void
    {
        ServiceToCompany::destroy($serviceId);
    }
}