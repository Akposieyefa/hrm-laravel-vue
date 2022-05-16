<?php

namespace App\Repositories\Contracts;

interface LeaveRepositoryInterface
{
    public function createLeave($request);

    public function getAllLeaves();

    public function getSingleLeave($id);

    public function updateLeave($request, $id);

    public function deleteLeave($id);
}

