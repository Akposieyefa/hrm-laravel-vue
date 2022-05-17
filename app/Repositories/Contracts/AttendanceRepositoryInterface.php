<?php

namespace App\Repositories\Contracts;

interface AttendanceRepositoryInterface
{
    public function clockIn($request);

    public function getAllMyAttendance();

    public function clockOut($request);

}
