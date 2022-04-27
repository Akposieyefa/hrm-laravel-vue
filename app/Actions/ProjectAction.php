<?php

namespace App\Actions;

use Illuminate\Http\JsonResponse;
use App\Models\Project;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectAction
{
    /**
     * @var Project
     */
    private Project $model;

    /**
     * @param Project $model
     */
    public function __construct(Project $model)
    {
        $this->model = $model;
    }

    /**
     * @param $req
     * @return JsonResponse
     */
    public function createProAction($req): JsonResponse
    {
        try {
            $dpt = $this->model->create([
                'title' => $req->title,
                'description' => $req->description,
                'project_duration' => $req->project_duration,
                'organization_id' => auth()->user()->organization->id
            ]);
            return response()->json([
                'message' => 'Project created successfully',
                'data' => new ProjectResource($dpt),
                'success' => true
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Sorry unable to  created project',
                'error' => $e->getMessage(),
                'success' => false
            ], 400);
        }
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function  getAllProAction(): JsonResponse|AnonymousResourceCollection
    {
        $projects = $this->model->with(['organization'])->latest()->paginate(20);
        if (count($projects) < 1) {
            return response()->json([
                'message' => 'Sorry no department found',
                'success' => false
            ], 404);
        }else {
            return ProjectResource::collection($projects)->additional([
                'message' => "All project",
                'success' => true
            ], 200);
        }
    }

    /**
     * @param $id
     * @return ProjectResource|JsonResponse
     */
    public function getProAction($id): ProjectResource|JsonResponse
    {
        $data = $this->model->with(['organization'])->where('id', '=', $id)->exists();
        if ($data) {
            $project = $this->model->find($id);
            return (new ProjectResource($project))->additional( [
                'message' => "Project details",
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
    public function updateProAction($req, $id): JsonResponse
    {
        $data = $this->model->where('id', '=', $id)->exists();
        if ($data) {
            $pro = $this->model->find($id);
            $pro->slug = null;
            try {
                $update = $pro->update([
                    'title' => empty($req->title) ? $pro->title : $req->title,
                    'project_duration' => empty($req->project_duration) ? $pro->project_duration : $req->project_duration,
                    'description' =>   empty($req->description) ? $pro->description : $req->description
                ]);
                return response()->json([
                    'message' => 'Project updated successfully',
                    'data' => new ProjectResource($pro),
                    'success' => true
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Sorry unable to  updated project details',
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
    public function deleteProAction($id): JsonResponse
    {
        $data = $this->model->where('id', '=', $id)->exists();
        if ($data) {
            $pro =  $this->model->find($id);
            try {
                $pro->delete();
                return response()->json([
                    'message' => 'Department deleted successfully',
                    'data' => new ProjectResource($pro),
                    'success' => true
                ], 200);
            }catch (\Exception $e) {
                return response()->json([
                    'message' => 'Sorry unable to delete project',
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
