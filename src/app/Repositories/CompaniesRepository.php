<?php

namespace App\Repositories;

use App\Interfaces\CompaniesRepositoryInterface;
use App\Models\Companies;
use Illuminate\Pagination\Paginator;

class CompaniesRepository implements CompaniesRepositoryInterface
{
    public function createCompany(array $companyDetails): Companies
    {
        return Companies::create($companyDetails);
    }

    public function getCompanyById(int $companyId): ?Companies
    {
        return Companies::find($companyId);
    }

    public function getCompanies(): Paginator
    {
        return Companies::simplePaginate(10);
    }

    public function updateCompany(int $companyId, array $companyDetails): void
    {
        Companies::whereId($companyId)->update($companyDetails);
    }

    public function deleteCompany(int $companyId): void
    {
        Companies::destroy($companyId);
    }
}