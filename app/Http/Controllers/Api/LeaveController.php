<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\LeaveRepositoryInterface;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    private LeaveRepositoryInterface $leaveRepositoryInterface;

    public function __construct(LeaveRepositoryInterface $leaveRepositoryInterface)
    {
        return $this->leaveRepositoryInterface = $leaveRepositoryInterface;
    }

    public function index()
    {
        return $this->leaveRepositoryInterface->getAllLeaves();
    }

    public function store(Request $request)
    {
        return $this->leaveRepositoryInterface->createLeave($request);
    }

    public function show($id)
    {
        return $this->leaveRepositoryInterface->getSingleLeave($id);
    }

    public function update(Request $request, $id)
    {
        return $this->leaveRepositoryInterface->updateLeave($request, $id);
    }

    public function destroy($id)
    {
        return $this->leaveRepositoryInterface->deleteLeave($id);
    }
}
