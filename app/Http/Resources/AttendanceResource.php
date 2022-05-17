<?php

namespace App\Http\Resources;

use App\Helpers\SystemHelper;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $auth_date
 * @property mixed $clock_in
 * @property mixed $clock_out
 * @property mixed $ip_address
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class AttendanceResource extends JsonResource
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
            'auth_date' => $this->auth_date,
            'clock_in' => $this->clock_in,
            'clock_out' => $this->clock_out,
            'ip_address' => $this->ip_address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
