<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Comment extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'comments';

    protected $fillable = [
        'post_id', 'name', 'email', 'content', 'status', 'ip_address',
        'parent_id',
    ];

    protected $casts = [];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
