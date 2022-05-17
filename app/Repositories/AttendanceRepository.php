<?php

namespace App\Repositories;

use App\Repositories\Contracts\AttendanceRepositoryInterface;
use App\Actions\AttendanceAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;

/**
 *
 */
class AttendanceRepository implements AttendanceRepositoryInterface
{
    /**
     * @var AttendanceAction
     */
    private AttendanceAction $action;

    /**
     * @param AttendanceAction $action
     */
    public function __construct(AttendanceAction $action)
    {
        $this->action = $action;
    }

    /**
     * get all attendance
     * @param $request
     * @return JsonResponse
     */
    public function clockIn($request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'auth_date' => 'required',
            'clock_in' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'success' => false
            ], 422);
        }else {
            return $this->action->clockInAction($request);
        }
    }

    /**
     * clock out employee for the day
     * @param $request
     * @return JsonResponse
     */
    public function clockOut($request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'auth_date' => 'required',
            'clock_out' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'success' => false
            ], 422);
        }else {
            return $this->action->clockOutAction($request);
        }
    }

    /**
     * get all my attendance
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getAllMyAttendance(): JsonResponse|AnonymousResourceCollection
    {
        return $this->action->getMyAttendanceRecordAction();
    }
}
