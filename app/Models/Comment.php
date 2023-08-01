<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'body',
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
