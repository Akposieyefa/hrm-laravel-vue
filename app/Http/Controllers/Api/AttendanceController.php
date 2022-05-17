<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\AttendanceRepositoryInterface;
use Illuminate\Http\Request;

/**
 *
 */
class AttendanceController extends Controller
{
    /**
     * @var AttendanceRepositoryInterface
     */
    private AttendanceRepositoryInterface $attendanceRepositoryInterface;

    /**
     * @param AttendanceRepositoryInterface $attendanceRepositoryInterface
     */
    public function __construct(AttendanceRepositoryInterface $attendanceRepositoryInterface)
    {
        $this->attendanceRepositoryInterface = $attendanceRepositoryInterface;
    }

    /**
     * store attendance
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request): mixed
    {
        return $this->attendanceRepositoryInterface->clockIn($request);
    }

    /**
     * clock out employees
     * @param Request $request
     * @return mixed
     */
    public function clockOutEmployee(Request $request): mixed
    {
        return $this->attendanceRepositoryInterface->clockOut($request);
    }

    /**
     * get all my attendance
     * @return mixed
     */
    public function index(): mixed
    {
        return $this->attendanceRepositoryInterface->getAllMyAttendance();
    }

}
