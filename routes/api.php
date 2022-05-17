<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\HelperController;
use App\Http\Controllers\Api\LeaveController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function ($router) {

    Route::post('/login', [AuthController::class, 'login']);

    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::controller(AuthController::class)->group(function () {
            Route::post('logout', 'logout');
            Route::get('user-profile', 'userProfile');
        });

        Route::controller(DepartmentController::class)->group(function () {
            Route::post('departments', 'store');
            Route::get('departments', 'index');
            Route::get('departments/{id}', 'show');
            Route::patch('departments/{id}', 'update');
            Route::delete('departments/{id}', 'destroy');
        });

        Route::controller(OrganizationController::class)->group(function () {
            Route::post('organizations', 'store');
            Route::get('organizations', 'index');
            Route::get('organizations/{id}', 'show');
            Route::patch('organizations/{id}', 'update');
            Route::delete('organizations/{id}', 'destroy');
        });

        Route::controller(LevelController::class)->group(function () {
            Route::post('levels', 'store');
            Route::get('levels', 'index');
            Route::get('levels/{id}', 'show');
            Route::patch('levels/{id}', 'update');
            Route::delete('levels/{id}', 'destroy');
        });

        Route::controller(EmployeeController::class)->group(function () {
            Route::post('employees', 'store');
            Route::get('employees', 'index');
            Route::get('employees-attendances', 'getEmployeeAttendanceRecord');
            Route::get('employees/{id}', 'show');
            Route::patch('employees/{id}', 'update');
            Route::delete('employees/{id}', 'destroy');
        });

        Route::controller(ProjectController::class)->group(function () {
            Route::post('projects', 'store');
            Route::get('projects', 'index');
            Route::get('projects/{id}', 'show');
            Route::patch('projects/{id}', 'update');
            Route::delete('projects/{id}', 'destroy');
        });

        Route::controller(LeaveController::class)->group(function () {
            Route::post('leaves', 'store');
            Route::get('leaves', 'index');
            Route::get('leaves/{id}', 'show');
            Route::patch('leaves/{id}', 'update');
            Route::delete('leaves/{id}', 'destroy');
        });

        Route::controller(TaskController::class)->group(function () {
            Route::post('tasks', 'store');
            Route::get('tasks', 'index');
            Route::get('tasks/{id}', 'show');
            Route::patch('tasks/{id}', 'update');
            Route::delete('tasks/{id}', 'destroy');
        });

        Route::controller(AttendanceController::class)->group(function () {
            Route::post('attendances', 'store');
            Route::get('attendances', 'index');
            Route::patch('attendances', 'clockOutEmployee');
        });

        Route::controller(HelperController::class)->group(function () {
            Route::get('/create-helpers', 'createHelper');
            Route::get('/dashboard-helpers', 'dashboardHelper');
        });

    });
});

