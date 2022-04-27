<?php

namespace App\Repositories;

use App\Actions\ProjectAction;
use App\Http\Resources\ProjectResource;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;

class ProjectRepository implements ProjectRepositoryInterface
{
    /**
     * @var ProjectAction
     */
    private ProjectAction $action;

    /**
     * @param ProjectAction $action
     */
    public function __construct(ProjectAction $action)
    {
        $this->action = $action;
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function createProject($request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'project_duration' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'success' => false
            ], 422);
        }else {
            return $this->action->createProAction($request);
        }
    }

    /**
     * get all departments
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getAllProjects(): JsonResponse|AnonymousResourceCollection
    {
        return $this->action->getAllProAction();
    }

    /**
     * @param $id
     * @return ProjectResource|JsonResponse
     */
    public function getSingleProject($id): ProjectResource|JsonResponse
    {
        return $this->action->getProAction($id);
    }

    /**
     * @param $request
     * @param $id
     * @return JsonResponse
     */
    public function updateProject($request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes',
            'description' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'success' => false
            ], 422);
        }else {
            return $this->action->updateProAction($request, $id);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteProject($id): JsonResponse
    {
        return $this->action->deleteProAction($id);
    }

}
