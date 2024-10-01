<?php

namespace App\Interfaces;

interface CompaniesRepositoryInterface
{
    public function createCompany(array $companyDetails);
    public function getCompanyById(int $companyId);
    public function getCompanies();
    public function updateCompany(int $companyId, array $companyDetails);
    public function deleteCompany(int $companyId);
}
