<?php

namespace App\Http\Resources;

use App\Helpers\SystemHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $description
 * @property mixed $slug
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $employees
 */
class DepartmentResource extends JsonResource
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
            'name' => $clean->cleanStringHelper($this->name),
            'description' => $clean->cleanStringHelper($this->description),
            'employees' => $this->employees,
            'slug' => $clean->cleanStringHelper($this->slug),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
