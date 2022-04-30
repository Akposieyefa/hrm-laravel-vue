<?php

namespace App\Actions;

use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;
use App\Models\Task;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskAction
{

    /**
     * @var Task
     */
    private Task $model;

    /**
     * @param Task $model
     */
    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    /**
     * @param $req
     * @return JsonResponse
     */
    public function createTaskAction($req): JsonResponse
    {
        try {
            $task = $this->model->create([
                'title' => $req->title,
                'description' => $req->description,
                'project_id' => $req->project_id,
                'user_id' => $req->employee_id
            ]);
            return response()->json([
                'message' => 'Task created successfully',
                'data' => new TaskResource($task),
                'success' => true
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Sorry unable to  created task',
                'error' => $e->getMessage(),
                'success' => false
            ], 400);
        }
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function  getAllTaskAction(): JsonResponse|AnonymousResourceCollection
    {
        $tasks = $this->model->with(['employee', 'project'])->where('user_id', '=', auth()->user()->id)->latest()->paginate(20);
        if (count($tasks) < 1) {
            return response()->json([
                'message' => 'Sorry no task found',
                'success' => false
            ], 404);
        }else {
            return TaskResource::collection($tasks)->additional([
                'message' => "All task",
                'success' => true
            ], 200);
        }
    }

    /**
     * @param $id
     * @return TaskResource|JsonResponse
     */
    public function getTaskAction($id): TaskResource|JsonResponse
    {
        $data = $this->model->with(['project', 'employee'])->where('id', '=', $id)->exists();
        if ($data) {
            $task = $this->model->find($id);
            return (new TaskResource($task))->additional( [
                'message' => "Task details",
                'success' => true
            ], 200);
        }else {
            return response()->json([
                'message' => 'Sorry this data do not exist',
                'success' => false
            ], 404);
        }
    }

    /**
     * @param $req
     * @param $id
     * @return JsonResponse
     */
    public function updateTaskAction($req, $id): JsonResponse
    {
        $data = $this->model->where('id', '=', $id)->exists();
        if ($data) {
            $task = $this->model->find($id);
            $task->slug = null;
            try {
                $update = $task->update([
                    'status' => true,
                    'status_description' => $req->status_description
                ]);
                return response()->json([
                    'message' => 'Task updated successfully',
                    'data' => new TaskResource($task),
                    'success' => true
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Sorry unable to  updated task',
                    'error' => $e->getMessage(),
                    'success' => false
                ], 400);
            }
        }else {
            return response()->json([
                'message' => 'Sorry this data do not exist',
                'success' => false
            ], 404);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteTaskAction($id): JsonResponse
    {
        $data = $this->model->where('id', '=', $id)->exists();
        if ($data) {
            $task =  $this->model->find($id);
            try {
                $task->delete();
                return response()->json([
                    'message' => 'Task deleted successfully',
                    'data' => new TaskResource($task),
                    'success' => true
                ], 200);
            }catch (\Exception $e) {
                return response()->json([
                    'message' => 'Sorry unable to delete task',
                    'success' => false
                ], 400);
            }
        }else {
            return response()->json([
                'message' => 'Sorry this data do not exist',
                'success' => false
            ], 404);
        }
    }

}
