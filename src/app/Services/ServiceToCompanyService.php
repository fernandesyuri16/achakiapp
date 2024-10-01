<?php

namespace App\Services;

use App\Helpers\Http;
use App\Repositories\ServiceToCompanyRepository;

class ServiceToCompanyService
{
    use Http;

    private ServiceToCompanyRepository $repository;

    public function __construct()
    {
        $this->repository = new ServiceToCompanyRepository;
    }

    /**
     * Create a new service.
     *
     * @param array $serviceDetails - Details of the service.
     * @return array - Returns an array with the created service or an error message.
     */
    public function createService(array $serviceDetails): array
    {
        $serviceDetails['user_id'] = auth()->user()->id;

        $service = $this->repository->createService($serviceDetails);

        return $this->created($service);
    }

    /**
     * Get a specific service.
     *
     * @param int $serviceId - The ID of the service.
     * @return array - Returns an array with the service or an error message.
     */
    public function getServiceById(int $serviceId): array
    {
        $error = $this->checkIfHasError($serviceId);

        if (! empty($error)) {
            return $error;
        }

        $service = $this->repository->getServiceById($serviceId);

        return $this->ok($service);
    }

    /**
     * Get all services.
     *
     * @return array - Returns an array with all services.
     */
    public function getServices(): array
    {
        $services = $this->repository->getServices();

        return $this->ok($services->items());
    }

    /**
     * Check if there are any errors.
     *
     * @param int $serviceId - The ID of the company.
     * @param bool $checkPermission - Whether to check for permissions.
     * @return array - Returns an array with an error message if there are any errors.
     */
    private function checkIfHasError(int $serviceId, bool $checkPermission = false): array
    {
        $serviceDetails = $this->repository->getServiceById($serviceId);

        if (! $this->serviceExists($serviceId)) {
            return $this->notFound("Employee doesn't exists.");
        }

        if ($checkPermission && $serviceDetails['user_id'] !== auth()->user()->id) {
            return $this->forbidden("You don't have permission to perform this action.");
        }

        return [];
    }

    /**
     * Check if a service exists.
     *
     * @param int $serviceId - The ID of the service .
     * @return bool - Returns true if the service exists, false otherwise.
     */
    private function serviceExists(int $serviceId): bool
    {
        $service = $this->repository->getServiceById($serviceId);

        if (empty($service->id)) {
            return false;
        }

        return true;
    }

    /**
     * Update a specific service.
     *
     * @param int $serviceId - The ID of the service.
     * @param array $serviceDetails - The new details of the service.
     * @return array - Returns an array with the updated service or an error message.
     */
    public function updateService(int $serviceId, array $serviceDetails): array
    {
        $error = $this->checkIfHasError($serviceId, true);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->updateService($serviceId, $serviceDetails);

        $service = $this->repository->getServiceById($serviceId);

        return $this->ok($service);
    }

    /**
     * Delete a specific service.
     *
     * @param int $serviceId - The ID of the service.
     * @return array - Returns an array with a success message or an error message.
     */
    public function deleteService(int $serviceId): array
    {
        $error = $this->checkIfHasError($serviceId, true);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->deleteService($serviceId);

        return $this->ok('Service successfully deleted!');
    }
}
