<?php

namespace App\Repositories\Contracts;

interface EmployeeRepositoryInterface
{
    public function createEmployee($request);

    public function getAllEmployees();

    public function getSingleEmployee($id);

    public function updateEmployee($request, $id);

    public function deleteEmployee($id);

    public function getEmployeeAttendance();
}

