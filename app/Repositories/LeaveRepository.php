<?php

namespace App\Repositories;

use App\Actions\LeaveAction;
use App\Http\Resources\LeaveResource;
use App\Repositories\Contracts\LeaveRepositoryInterface;
use App\Actions\LevelAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;

/**
 * leave repository
 */
class LeaveRepository implements LeaveRepositoryInterface
{
    /**
     * @var LeaveAction
     */
    private LeaveAction $action;

    /**
     * @param LeaveAction $action
     */
    public function __construct(LeaveAction $action)
    {
        $this->action = $action;
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function createLeave($request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'leave_start_date' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'success' => false
            ], 422);
        }else {
            return $this->action->createLeaveAction($request);
        }
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getAllLeaves(): JsonResponse|AnonymousResourceCollection
    {
        return $this->action->getAllLeaveAction();
    }

    /**
     * @param $id
     * @return LeaveResource|JsonResponse
     */
    public function getSingleLeave($id): LeaveResource|JsonResponse
    {
        return $this->action->getLeaveAction($id);
    }

    /**
     * @param $request
     * @param $id
     * @return JsonResponse
     */
    public function updateLeave($request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'comment' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'success' => false
            ], 422);
        }else {
            return $this->action->updateLeaveAction($request, $id);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteLeave($id): JsonResponse
    {
        return $this->action->deleteLeaveAction($id);
    }
}
