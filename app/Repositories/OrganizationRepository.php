<?php

namespace App\Repositories;

use App\Actions\OrganizationAction;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\OrganizationResource;
use App\Repositories\Contracts\OrganizationRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;

class OrganizationRepository implements OrganizationRepositoryInterface
{
    /**
     * @var OrganizationAction
     */
    private OrganizationAction $action;

    /**
     * @param OrganizationAction $action
     */
    public function __construct(OrganizationAction $action)
    {
        $this->action = $action;
    }

    /**
     * create new department
     * @param $request
     * @return JsonResponse
     */
    public function createOrganization($request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'success' => false
            ], 422);
        }else {
            return $this->action->createOrgAction($request);
        }
    }

    /**
     * get all departments
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getAllOrganizations(): JsonResponse|AnonymousResourceCollection
    {
        return $this->action->getAllOrgAction();
    }

    /**
     * get single department
     * @param $id
     * @return OrganizationResource|JsonResponse
     */
    public function getSingleOrganization($id): OrganizationResource|JsonResponse
    {
        return $this->action->getOrgAction($id);
    }

    /**
     * update department
     * @param $request
     * @param $id
     * @return JsonResponse
     */
    public function updateOrganization($request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes',
            'description' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'success' => false
            ], 422);
        }else {
            return $this->action->updateOrgAction($request, $id);
        }
    }

    /**
     * delete department
     * @param $id
     * @return JsonResponse
     */
    public function deleteOrganization($id): JsonResponse
    {
        return $this->action->deleteOrgAction($id);
    }
}
