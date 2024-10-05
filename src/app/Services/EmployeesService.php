<?php

namespace App\Services;

use App\Helpers\Http;
use App\Repositories\EmployeesRepository;

class EmployeesService
{
    use Http;

    private EmployeesRepository $repository;

    public function __construct()
    {
        $this->repository = new EmployeesRepository;
    }

    /**
     * Create a new employee.
     *
     * @param array $employeeDetails - Details of the employee.
     * @return array - Returns an array with the created employee or an error message.
     */
    public function createEmployee(array $employeeDetails): array
    {
        $employeeDetails['user_id'] = auth()->user()->id;

        $employee = $this->repository->createEmployee($employeeDetails);

        return $this->created($employee);
    }

    /**
     * Get a specific employee.
     *
     * @param int $employeeId - The ID of the employee.
     * @return array - Returns an array with the employee or an error message.
     */
    public function getEmployeeById(int $employeeId): array
    {
        $error = $this->checkIfHasError($employeeId);

        if (! empty($error)) {
            return $error;
        }

        $company = $this->repository->getEmployeeById($employeeId);

        return $this->ok($company);
    }

    /**
     * Get all employees.
     *
     * @return array - Returns an array with all employees.
     */
    public function getEmployees(): array
    {
        $employees = $this->repository->getEmployees();

        return $this->ok($employees->items());
    }

    /**
     * Check if there are any errors.
     *
     * @param int $employeeId - The ID of the company.
     * @param bool $checkPermission - Whether to check for permissions.
     * @return array - Returns an array with an error message if there are any errors.
     */
    private function checkIfHasError(int $employeeId, bool $checkPermission = false): array
    {
        $employeeDetails = $this->repository->getEmployeeById($employeeId);

        if (! $this->employeeExists($employeeId)) {
            return $this->notFound("Employee doesn't exists.");
        }

        if ($checkPermission && $employeeDetails['user_id'] !== auth()->user()->id) {
            return $this->forbidden("You don't have permission to perform this action.");
        }

        return [];
    }

    /**
     * Check if a employee exists.
     *
     * @param int $employeeId - The ID of the employee .
     * @return bool - Returns true if the employee exists, false otherwise.
     */
    private function employeeExists(int $employeeId): bool
    {
        $employee = $this->repository->getEmployeeById($employeeId);

        if (empty($employee->id)) {
            return false;
        }

        return true;
    }

    /**
     * Update a specific employee.
     *
     * @param int $employeeId - The ID of the employee.
     * @param array $employeeDetails - The new details of the employee.
     * @return array - Returns an array with the updated employee or an error message.
     */
    public function updateEmployee(int $employeeId, array $employeeDetails): array
    {
        $error = $this->checkIfHasError($employeeId, true);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->updateEmployee($employeeId, $employeeDetails);

        $employee = $this->repository->getEmployeeById($employeeId);

        return $this->ok($employee);
    }

    /**
     * Delete a specific employee.
     *
     * @param int $employeeId - The ID of the employee.
     * @return array - Returns an array with a success message or an error message.
     */
    public function deleteEmployee(int $employeeId): array
    {
        $error = $this->checkIfHasError($employeeId, true);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->deleteEmployee($employeeId);

        return $this->ok('Employee successfully deleted!');
    }
}
