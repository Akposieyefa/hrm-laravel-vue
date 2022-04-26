<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method create(array $array)
 * @method where(string $string, string $string1, $id)
 * @method find($id)
 */
class Organization extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'user_id', 'organization_name', 'phone_number', 'office_address', 'slug'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'organization_name'
            ]
        ];
    }

}
