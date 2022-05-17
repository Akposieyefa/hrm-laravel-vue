<?php

namespace App\Repositories;

use App\Actions\EmployeeAction;
use App\Http\Resources\EmployeeResource;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;

/**
 *
 */
class EmployeeRepository implements EmployeeRepositoryInterface
{
    /**
     * @var EmployeeAction
     */
    private EmployeeAction $action;

    /**
     * @param EmployeeAction $action
     */
    public function __construct(EmployeeAction $action)
    {
        $this->action = $action;
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function createEmployee($request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'department_id' => 'required',
            'level_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'success' => false
            ], 422);
        }else {
            return $this->action->createEmpAction($request);
        }
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getAllEmployees(): JsonResponse|AnonymousResourceCollection
    {
        return $this->action->getAllEmpAction();
    }

    /**
     * get all my employee attendances
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getEmployeeAttendance(): JsonResponse|AnonymousResourceCollection
    {
        return $this->action->getEmployeeAttendanceAction();
    }

    /**
     * @param $id
     * @return EmployeeResource|JsonResponse
     */
    public function getSingleEmployee($id): EmployeeResource|JsonResponse
    {
        return $this->action->getEmpAction($id);
    }

    /**
     * @param $request
     * @param $id
     * @return JsonResponse
     */
    public function updateEmployee($request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'department_id' => 'required',
            'level_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'success' => false
            ], 422);
        }else {
            return $this->action->updateEmpAction($request, $id);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteEmployee($id): JsonResponse
    {
        return $this->action->deleteEmpAction($id);
    }

}
