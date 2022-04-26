<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method where(string $string, string $string1, $id)
 * @method find($id)
 * @method create(array $array)
 */
class Employee extends Model
{
    use HasFactory, SoftDeletes;

   protected $fillable = [
       'user_id', 'organization_id', 'department_id', 'level_id', 'phone_number', 'address'
   ];

   public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
   {
       return $this->belongsTo(User::class, 'user_id');
   }

   public function organization(): \Illuminate\Database\Eloquent\Relations\BelongsTo
   {
       return $this->belongsTo(Organization::class, 'organization_id');
   }

   public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
   {
       return $this->belongsTo(Department::class, 'department_id');
   }

   public function level(): \Illuminate\Database\Eloquent\Relations\BelongsTo
   {
       return $this->belongsTo(Level::class, 'level_id');
   }

}
