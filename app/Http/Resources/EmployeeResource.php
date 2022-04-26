<?php

namespace App\Http\Resources;

use App\Helpers\SystemHelper;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $user
 * @property mixed $department
 * @property mixed $level
 * @property mixed $organization
 * @property mixed $phone_number
 * @property mixed $address
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $clean = new SystemHelper();
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'department' => new DepartmentResource($this->department),
            'level' => new LevelResource($this->level),
            'organization' => new OrganizationResource($this->organization),
            'phone' => $clean->cleanStringHelper($this->phone_number),
            'address' => $clean->cleanStringHelper($this->address),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
