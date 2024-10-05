<?php

namespace App\Repositories;

use App\Interfaces\EmployeesToServiceRepositoryInterface;
use App\Models\EmployeeToService;
use Illuminate\Pagination\Paginator;

class EmployeeToServiceRepository implements EmployeesToServiceRepositoryInterface
{
    public function createEmployee(array $employeeDetails): EmployeeToService
    {
        return EmployeeToService::create($employeeDetails);
    }

    public function getEmployeeById(int $employeeId): ?EmployeeToService
    {
        return EmployeeToService::find($employeeId);
    }

    public function getEmployees(): Paginator
    {
        return EmployeeToService::simplePaginate(20);
    }

    public function updateEmployee(int $employeeId, array $employeeDetails): void
    {
        EmployeeToService::whereId($employeeId)->update($employeeDetails);
    }

    public function deleteEmployee(int $employeeId): void
    {
        EmployeeToService::destroy($employeeId);
    }
}