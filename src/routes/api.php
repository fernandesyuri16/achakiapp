<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\EmployeeToServiceController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ServiceToCompanyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/users', [UserController::class, 'store'])->name('user.store');
Route::post('/token', [AuthController::class, 'generateToken'])->name('auth.generateToken');

Route::middleware("auth:sanctum")->group(function () {
    Route::apiResource('users', UserController::class)->except('store');
    Route::apiResource('schedule', SchedulesController::class);
    Route::apiResource('company', CompaniesController::class);
    Route::apiResource('services', ServicesController::class);
    Route::apiResource('employees', EmployeesController::class);
    Route::apiResource('employees/employee_to_service', EmployeeToServiceController::class);
    Route::apiResource('services/service_to_company', ServiceToCompanyController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
