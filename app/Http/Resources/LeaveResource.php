<?php

namespace App\Http\Resources;

use App\Helpers\SystemHelper;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $slug
 * @property mixed $id
 * @property mixed $title
 * @property mixed $description
 * @property mixed $status
 * @property mixed $approval_comment
 * @property mixed $leave_start_date
 * @property mixed $user
 */
class LeaveResource extends JsonResource
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
            'title' => $clean->cleanStringHelper($this->title),
            'description' => $clean->cleanStringHelper($this->description),
            'leave_start_date' => $this->leave_start_date,
            'status' => $clean->cleanStringHelper($this->status),
            'comment' => $clean->cleanStringHelper($this->approval_comment),
            'slug' => $clean->cleanStringHelper($this->slug),
            'user' => new UserResource($this->user),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
