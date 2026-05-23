<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Newsletter extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'newsletters';

    protected $fillable = ['email', 'name', 'status', 'token'];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
