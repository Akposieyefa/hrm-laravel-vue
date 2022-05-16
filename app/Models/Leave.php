<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method create(array $array)
 * @method latest()
 * @method where(string $string, string $string1, $id)
 * @method find($id)
 */
class Leave extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = [
        'user_id', 'title', 'description', 'leave_start_date', 'status',  'approval_comment', 'slug'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


}
