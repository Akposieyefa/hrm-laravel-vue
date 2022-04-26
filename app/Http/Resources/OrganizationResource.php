<?php

namespace App\Http\Resources;

use App\Helpers\SystemHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $organization_name
 * @property mixed $phone_number
 * @property mixed $office_address
 * @property mixed $slug
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $user
 */
class OrganizationResource extends JsonResource
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
            'org_name' => $clean->cleanStringHelper($this->organization_name),
            'org_phone' => $clean->cleanStringHelper($this->phone_number),
            'org_address' => $clean->cleanStringHelper($this->office_address),
            'slug' => $clean->cleanStringHelper($this->slug),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
