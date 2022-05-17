<?php

namespace App\Actions;

use App\Enums\RolesEnum;
use App\Models\Employee;
use App\Http\Resources\EmployeeResource;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * create employee
 */
class EmployeeAction
{
    /**
     * @var Employee
     */
    private Employee $model;
    /**
     * @var User
     */
    private User $user_model;

    /**
     * @param Employee $model
     * @param User $user_model
     */
    public function __construct(Employee $model, User $user_model)
    {
        $this->model = $model;
        $this->user_model = $user_model;
    }

    /**
     * @param $req
     * @return JsonResponse
     */
    public function createEmpAction($req): JsonResponse
    {
        DB::beginTransaction();
        try {
            $user = $this->user_model->create([
                'name' => $req->name,
                'email' => $req->email,
                'password' => bcrypt('password'),
                'role' => RolesEnum::EMPLOYEE,
                'email_verified_at' => now()
            ]);
            $org = $this->model->create([
                'user_id' => $user->id,
                'phone_number' => $req->phone,
                'address' => $req->address,
                'department_id' => $req->department_id,
                'level_id' => $req->level_id,
                'organization_id' => auth()->user()->organization->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Sorry unable to  created organization',
                'error' => $e->getMessage(),
                'success' => false
            ], 400);
        }
        DB::commit();
        return response()->json([
            'message' => 'Organization created successfully',
            'data' => new EmployeeResource($org),
            'success' => true
        ], 200);
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function  getAllEmpAction(): JsonResponse|AnonymousResourceCollection
    {
        $employees = $this->model->with(['user'])->latest()->paginate(20);
        if (count($employees) < 1) {
            return response()->json([
                'message' => 'Sorry no employee found',
                'success' => false
            ], 404);
        }else {
            return EmployeeResource::collection($employees)->additional([
                'message' => "All my employees",
                'success' => true
            ], 200);
        }
    }

    /**
     * @param $id
     * @return EmployeeResource|JsonResponse
     */
    public function getEmpAction($id): EmployeeResource|JsonResponse
    {
        $data = $this->model->with(['user'])->where('id', '=', $id)->exists();
        if ($data) {
            $emp = $this->model->find($id);
            return (new EmployeeResource($emp))->additional( [
                'message' => "Employee details",
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
    public function updateEmpAction($req, $id): JsonResponse
    {
        $data = $this->model->where('id', '=', $id)->exists();
        if ($data) {
            $emp = $this->model->find($id);
            try {
                $update = $emp->update([
                    'name' => empty($req->name) ? $emp->name : $req->name,
                ]);
                return response()->json([
                    'message' => 'Employee updated successfully',
                    'data' => new EmployeeResource($emp),
                    'success' => true
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Sorry unable to  updated employee details',
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
     * get all my employee attendances
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getEmployeeAttendanceAction(): JsonResponse|AnonymousResourceCollection
    {
        $employeesAttendance = $this->model->with(['attendances' => function ($query) {
            $query->select(['id', 'employee_id',  'auth_date', 'clock_in', 'clock_out', 'ip_address'])->orderBy('auth_date', 'desc');
        }])->where('organization_id', '=', auth()->user()->organization->id)->get();
        if (count($employeesAttendance) < 1) {
            return response()->json([
                'message' => 'Sorry no attendance record found',
                'success' => false
            ], 404);
        }else {
            return EmployeeResource::collection($employeesAttendance)->additional([
                'message' => "All my employees attendance records",
                'success' => true
            ], 200);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteEmpAction($id): JsonResponse
    {
        $data = $this->model->where('id', '=', $id)->exists();
        if ($data) {
            $emp =  $this->model->find($id);
            try {
                $emp->delete();
                return response()->json([
                    'message' => 'Employee deleted successfully',
                    'data' => new EmployeeResource($emp),
                    'success' => true
                ], 200);
            }catch (\Exception $e) {
                return response()->json([
                    'message' => 'Sorry unable to delete employee',
                    'success' => false
                ], 400);
            }
        }else {
            return response()->json([
                'message' => 'Sorry this organization do not exist',
                'success' => false
            ], 404);
        }
    }

}
