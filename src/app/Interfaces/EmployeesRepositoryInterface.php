<?php

namespace App\Interfaces;

interface EmployeesRepositoryInterface
{
    public function createEmployee(array $employeeDetails);
    public function getEmployeeById(int $employeeId);
    public function getEmployees();
    public function updateEmployee(int $employeeId, array $employeeDetails);
    public function deleteEmployee(int $employeeId);
}
