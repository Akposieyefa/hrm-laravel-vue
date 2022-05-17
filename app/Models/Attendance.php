<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method create(array $array)
 * @method where(string $string, string $string1, $id)
 */
class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    protected  $fillable = [
        'employee_id', 'auth_date', 'clock_in', 'clock_out', 'ip_address'
    ];

    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

}
