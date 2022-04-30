<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TaskRepositoryInterface;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private TaskRepositoryInterface $taskRepositoryInterface;

    public function __construct(TaskRepositoryInterface $taskRepositoryInterface)
    {
        $this->taskRepositoryInterface= $taskRepositoryInterface;
    }

    public function index()
    {
        return  $this->taskRepositoryInterface->getAllTasks();
    }

    public function store(Request $request)
    {
        return $this->taskRepositoryInterface->createTask($request);
    }

    public function show(int $id)
    {
        return $this->taskRepositoryInterface->getSingleTask($id);
    }

    public function update(Request $request, int $id)
    {
        return $this->taskRepositoryInterface->updateTask($request, $id);
    }

    public function destroy(int $id)
    {
        return $this->taskRepositoryInterface->deleteTask($id);
    }
}
