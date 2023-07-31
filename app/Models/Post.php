<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'photo_path',
        'body',
        'soft_delete'
    ];

    /**
     * null the updated_at column when creating the model
     */
    protected static function booted(): void
    {
        static::creating(function (self $model) {
            $model->updated_at = null;
        });

        static::updating(function (self $model) {
            $model->updated_at = now()->toTimeString();
        });
    }
}
