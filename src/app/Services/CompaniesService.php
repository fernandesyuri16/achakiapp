<?php

namespace App\Services;

use App\Helpers\Http;
use App\Repositories\CompaniesRepository;

class CompaniesService
{
    use Http;

    private CompaniesRepository $repository;

    public function __construct()
    {
        $this->repository = new CompaniesRepository;
    }

    /**
     * Create a new company.
     *
     * @param array $companyDetails - Details of the company.
     * @return array - Returns an array with the created company or an error message.
     */
    public function createCompany(array $companyDetails): array
    {
        $companyDetails['user_id'] = auth()->user()->id;

        $company = $this->repository->createCompany($companyDetails);

        return $this->created($company);
    }

    /**
     * Get a specific company.
     *
     * @param int $companyId - The ID of the company.
     * @return array - Returns an array with the company or an error message.
     */
    public function getCompanyById(int $companyId): array
    {
        $error = $this->checkIfHasError($companyId);

        if (! empty($error)) {
            return $error;
        }

        $company = $this->repository->getCompanyById($companyId);

        return $this->ok($company);
    }

    /**
     * Get all companies.
     *
     * @return array - Returns an array with all companies.
     */
    public function getCompanies(): array
    {
        $companies = $this->repository->getCompanies();

        return $this->ok($companies->items());
    }

    /**
     * Check if there are any errors.
     *
     * @param int $companyId - The ID of the company.
     * @param bool $checkPermission - Whether to check for permissions.
     * @return array - Returns an array with an error message if there are any errors.
     */
    private function checkIfHasError(int $companyId, bool $checkPermission = false): array
    {
        $companyDetails = $this->repository->getCompanyById($companyId);

        if (! $this->companyExists($companyId)) {
            return $this->notFound("Company doesn't exists.");
        }

        if ($checkPermission && $companyDetails['user_id'] !== auth()->user()->id) {
            return $this->forbidden("You don't have permission to perform this action.");
        }

        return [];
    }

    /**
     * Check if a company exists.
     *
     * @param int $companyId - The ID of the company .
     * @return bool - Returns true if the company exists, false otherwise.
     */
    private function companyExists(int $companyId): bool
    {
        $company = $this->repository->getCompanyById($companyId);

        if (empty($company->id)) {
            return false;
        }

        return true;
    }

    /**
     * Update a specific company.
     *
     * @param int $companyId - The ID of the company.
     * @param array $companyDetails - The new details of the company.
     * @return array - Returns an array with the updated company or an error message.
     */
    public function updateCompany(int $companyId, array $companyDetails): array
    {
        $error = $this->checkIfHasError($companyId, true);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->updateCompany($companyId, $companyDetails);

        $company = $this->repository->getCompanyById($companyId);

        return $this->ok($company);
    }

    /**
     * Delete a specific company.
     *
     * @param int $companyId - The ID of the company.
     * @return array - Returns an array with a success message or an error message.
     */
    public function deleteCompany(int $companyId): array
    {
        $error = $this->checkIfHasError($companyId, true);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->deleteCompany($companyId);

        return $this->ok('Company successfully deleted!');
    }
}
