<?php

namespace App\Actions;

use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 *
 */
class AttendanceAction
{
    /**
     * @var Attendance
     */
    private Attendance $model;

    /**
     * @param Attendance $model
     */
    public function __construct(Attendance $model)
    {
        $this->model = $model;
    }

    /**
     * clock in and clock out
     * @param $request
     * @return JsonResponse
     */
    public function clockInAction($request): JsonResponse
    {
        $queryDate = Carbon::createFromFormat('Y-m-d', $request->auth_date);
        $todayAttendanceCheck = $this->model->where('employee_id', '=', auth()->user()->employee->id)
            ->whereDate('auth_date', '=', $queryDate)->exists();

        if (!$todayAttendanceCheck) {
            try {
                $this->model->create([
                    'employee_id' => auth()->user()->employee->id,
                    'auth_date' =>  $request->auth_date,
                    'clock_in' => $request->clock_in,
                    'ip_address' => $request->ip()
                ]);
                return response()->json([
                    'message' => 'Attendance marked successfully',
                    'data' => auth()->user(),
                    'success' => true
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Sorry unable to create attendance record',
                    'error' => $e->getMessage(),
                    'success' => false
                ], 400);
            }
        } else {
            return response()->json([
                'message' => 'Sorry you have clocked in for today',
                'data' => auth()->user(),
                'success' => true
            ], 400);
        }
    }

    /**
     * clock out employee for the day
     * @param $request
     * @return JsonResponse
     */
    public function clockOutAction($request): JsonResponse
    {
        $queryDate = Carbon::createFromFormat('Y-m-d', $request->auth_date);
        $todayAttendance= $this->model->where('employee_id', '=', auth()->user()->employee->id)
            ->whereDate('auth_date', '=', $queryDate)->first();
        try {
            $todayAttendance->update([
                'clock_out' => $request->clock_out
            ]);
            return response()->json([
                'message' => 'Employee clocked out successfully',
                'data' => auth()->user(),
                'success' => true
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Sorry unable to clock out for the day',
                'error' => $e->getMessage(),
                'success' => true
            ], 400);
        }
    }

    /**
     * get all my attendance
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getMyAttendanceRecordAction(): JsonResponse|AnonymousResourceCollection
    {
        $attendance = $this->model->where('employee_id', '=', auth()->user()->employee->id)->get();
        if (count($attendance) < 1) {
            return response()->json([
                'message' => 'Sorry no attendance record found',
                'success' => false
            ], 404);
        } else {
            return AttendanceResource::collection($attendance)->additional([
                'message' => "All my attendance",
                'success' => true
            ], 200);
        }
    }

}
