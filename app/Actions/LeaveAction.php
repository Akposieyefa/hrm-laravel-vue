<?php

namespace App\Actions;

use App\Models\Leave;
use App\Http\Resources\LeaveResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * leave action
 */
class LeaveAction
{
    /**
     * @var Leave
     */
    private Leave $model;

    /**
     * @param Leave $model
     */
    public function __construct(Leave $model)
    {
        $this->model = $model;
    }

    /**
     * apply for leave
     * @param $req
     * @return JsonResponse
     */
    public function createLeaveAction($req): JsonResponse
    {
        try {
            $lev = $this->model->create([
                'user_id' => auth()->user()->id,
                'title' => $req->title,
                'description' => $req->description,
                'leave_start_date' => $req->leave_start_date
            ]);
            return response()->json([
                'message' => 'Leave created successfully',
                'data' => new LeaveResource($lev),
                'success' => true
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Sorry unable to  created leave',
                'error' => $e->getMessage(),
                'success' => false
            ], 400);
        }
    }

    /**
     * get all leave
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function  getAllLeaveAction(): JsonResponse|AnonymousResourceCollection
    {
        $leaves = $this->model->latest()->paginate(20);
        if (count($leaves) < 1) {
            return response()->json([
                'message' => 'Sorry no leave found',
                'success' => false
            ], 404);
        }else {
            return LeaveResource::collection($leaves)->additional([
                'message' => "All leaves",
                'success' => true
            ], 200);
        }
    }

    /**
     * get single leave
     * @param $id
     * @return LeaveResource|JsonResponse
     */
    public function getLeaveAction($id): LeaveResource|JsonResponse
    {
        $data = $this->model->where('id', '=', $id)->exists();
        if ($data) {
            $leave = $this->model->find($id);
            return (new LeaveResource($leave))->additional( [
                'message' => "Level details",
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
     * update leave
     * @param $req
     * @param $id
     * @return JsonResponse
     */
    public function updateLeaveAction($req, $id): JsonResponse
    {
        $data = $this->model->where('id', '=', $id)->exists();
        if ($data) {
            $leave = $this->model->find($id);
            $leave->slug = null;
            try {
                $update = $leave->update([
                    'status' => empty($req->status) ? $leave->status : $req->status,
                    'approval_comment' => empty($req->comment) ? $leave->approval_comment : $req->comment
                ]);
                return response()->json([
                    'message' => 'Leave updated successfully',
                    'data' => new LeaveResource($leave),
                    'success' => true
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Sorry unable to  updated leave details',
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
     * delete leave
     * @param $id
     * @return JsonResponse
     */
    public function deleteLeaveAction($id): JsonResponse
    {
        $data = $this->model->where('id', '=', $id)->exists();
        if ($data) {
            $leave =  $this->model->find($id);
            try {
                $leave->delete();
                return response()->json([
                    'message' => 'Leave deleted successfully',
                    'data' => new LeaveResource($leave),
                    'success' => true
                ], 200);
            }catch (\Exception $e) {
                return response()->json([
                    'message' => 'Sorry unable to delete leave',
                    'success' => false
                ], 400);
            }
        }else {
            return response()->json([
                'message' => 'Sorry this leave do not exist',
                'success' => false
            ], 404);
        }
    }

}
