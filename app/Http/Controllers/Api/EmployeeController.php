<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private EmployeeRepositoryInterface $employeeRepositoryInterface ;

    public function __construct(EmployeeRepositoryInterface  $employeeRepositoryInterface)
    {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
    }

    public function index()
    {
        return  $this->employeeRepositoryInterface->getAllEmployees();
    }

    public function store(Request $request)
    {
        return $this->employeeRepositoryInterface->createEmployee($request);
    }

    public function show(int $id)
    {
        return $this->employeeRepositoryInterface->getSingleEmployee($id);
    }

    public function update(Request $request, int $id)
    {
        return $this->employeeRepositoryInterface->updateEmployee($request, $id);
    }

    public function getEmployeeAttendanceRecord()
    {
        return $this->employeeRepositoryInterface->getEmployeeAttendance();
    }

    public function destroy(int $id)
    {
        return $this->employeeRepositoryInterface->deleteEmployee($id);
    }
}
