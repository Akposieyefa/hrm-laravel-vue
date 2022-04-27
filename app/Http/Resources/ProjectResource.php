<?php

namespace App\Http\Resources;

use App\Helpers\SystemHelper;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $organization
 * @property mixed $title
 * @property mixed $description
 * @property mixed $project_duration
 * @property mixed $slug
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class ProjectResource extends JsonResource
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
            'organization' => new OrganizationResource($this->organization),
            'title' => $clean->cleanStringHelper($this->title),
            'description' => $clean->cleanStringHelper($this->description),
            'project_duration' => $clean->cleanStringHelper($this->project_duration),
            'slug' => $clean->cleanStringHelper($this->slug),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
