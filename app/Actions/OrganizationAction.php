<?php

namespace App\Actions;

use App\Enums\RolesEnum;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 *
 */
class OrganizationAction
{
    /**
     * @var Organization
     */
    private Organization $model;
    /**
     * @var User
     */
    private User $user_model;

    /**
     * @param Organization $model
     * @param User $user_model
     */
    public function __construct(Organization $model, User $user_model)
    {
        $this->model = $model;
        $this->user_model = $user_model;;
    }

    /**
     * @param $req
     * @return JsonResponse
     */
    public function createOrgAction($req): JsonResponse
    {
        try {
            $user = $this->user_model->create([
                'name' => $req->name,
                'email' => $req->email,
                'password' => bcrypt('password'),
                'role' => RolesEnum::ADMIN,
                'email_verified_at' => now()
            ]);
            $org = $this->model->create([
                'user_id' => $user->id,
                'organization_name' => $req->name,
                'phone_number' => $req->phone,
                'office_address' => $req->address
            ]);
            return response()->json([
                'message' => 'Organization created successfully',
                'data' => new OrganizationResource($org),
                'success' => true
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Sorry unable to  created organization',
                'error' => $e->getMessage(),
                'success' => false
            ], 400);
        }
    }

    /**
     * get all department created
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function  getAllOrgAction(): JsonResponse|AnonymousResourceCollection
    {
        $organizations = $this->model->with(['user'])->latest()->paginate(20);
        if (count($organizations) < 1) {
            return response()->json([
                'message' => 'Sorry no department found',
                'success' => false
            ], 404);
        }else {
            return OrganizationResource::collection($organizations)->additional([
                'message' => "All organizations",
                'success' => true
            ], 200);
        }
    }

    /**
     * get single department
     * @param $id
     * @return OrganizationResource|JsonResponse
     */
    public function getOrgAction($id): OrganizationResource|JsonResponse
    {
        $data = $this->model->with(['user'])->where('id', '=', $id)->exists();
        if ($data) {
            $org = $this->model->find($id);
            return (new OrganizationResource($org))->additional( [
                'message' => "Organization details",
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
     * update department details
     * @param $req
     * @param $id
     * @return JsonResponse
     */
    public function updateOrgAction($req, $id): JsonResponse
    {
        $data = $this->model->where('id', '=', $id)->exists();
        if ($data) {
            $org = $this->model->find($id);
            $org->slug = null;
            try {
                $update = $org->update([
                    'name' => empty($req->name) ? $org->name : $req->name,
                ]);
                return response()->json([
                    'message' => 'Organization updated successfully',
                    'data' => new OrganizationResource($org),
                    'success' => true
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Sorry unable to  updated organization details',
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
     * delete department
     * @param $id
     * @return JsonResponse
     */
    public function deleteOrgAction($id): JsonResponse
    {
        $data = $this->model->where('id', '=', $id)->exists();
        if ($data) {
            $org =  $this->model->find($id);
            try {
                $org->delete();
                return response()->json([
                    'message' => 'Organization deleted successfully',
                    'data' => new OrganizationResource($org),
                    'success' => true
                ], 200);
            }catch (\Exception $e) {
                return response()->json([
                    'message' => 'Sorry unable to delete organization',
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
