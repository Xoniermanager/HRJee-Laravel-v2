<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    protected $fillable = [
        'user_id', 'title', 'body', 'data', 'token', 'success', 'response'
    ];

    protected $casts = [
        'data' => 'array',
        'success' => 'boolean',
    ];
}
