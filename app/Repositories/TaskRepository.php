<?php

namespace App\Repositories;

use App\Actions\TaskAction;
use App\Http\Resources\TaskResource;
use App\Repositories\Contracts\TaskRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @var TaskAction
     */
    private TaskAction $action;

    /**
     * @param TaskAction $action
     */
    public function __construct(TaskAction $action)
    {
        $this->action = $action;
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function createTask($request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'project_id' => 'required',
            'description' => 'required',
            'employee_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'success' => false
            ], 422);
        }else {
            return $this->action->createTaskAction($request);
        }
    }

    /**
     * get all departments
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getAllTasks(): JsonResponse|AnonymousResourceCollection
    {
        return $this->action->getAllTaskAction();
    }

    /**
     * @param $id
     * @return TaskResource|JsonResponse
     */
    public function getSingleTask($id): TaskResource|JsonResponse
    {
        return $this->action->getTaskAction($id);
    }

    /**
     * @param $request
     * @param $id
     * @return JsonResponse
     */
    public function updateTask($request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status_description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'success' => false
            ], 422);
        }else {
            return $this->action->updateTaskAction($request, $id);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteTask($id): JsonResponse
    {
        return $this->action->deleteTaskAction($id);
    }

}
