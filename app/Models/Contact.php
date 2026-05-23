<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Contact extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'contacts';

    protected $fillable = [
        'name', 'email', 'subject', 'message', 'status',
        'admin_reply', 'replied_at', 'ip_address', 'reply_history', 'delivery_status'
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];

    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }
}
