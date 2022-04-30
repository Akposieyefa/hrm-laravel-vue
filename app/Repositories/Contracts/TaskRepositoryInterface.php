<?php

namespace App\Repositories\Contracts;

interface TaskRepositoryInterface
{
    public function createTask($request);

    public function getAllTasks();

    public function getSingleTask($id);

    public function updateTask($request, $id);

    public function deleteTask($id);
}
