<?php

namespace App\Repositories;

use App\Interfaces\EmployeesRepositoryInterface;
use App\Models\Employees;
use Illuminate\Pagination\Paginator;

class EmployeesRepository implements EmployeesRepositoryInterface
{
    public function createEmployee(array $employeeDetails): Employees
    {
        return Employees::create($employeeDetails);
    }

    public function getEmployeeById(int $employeeId): ?Employees
    {
        return Employees::find($employeeId);
    }

    public function getEmployees(): Paginator
    {
        return Employees::simplePaginate(20);
    }

    public function updateEmployee(int $employeeId, array $employeeDetails): void
    {
        Employees::whereId($employeeId)->update($employeeDetails);
    }

    public function deleteEmployee(int $employeeId): void
    {
        Employees::destroy($employeeId);
    }
}