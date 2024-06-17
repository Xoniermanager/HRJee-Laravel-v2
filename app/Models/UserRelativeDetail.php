<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRelativeDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'relation_name',
        'name',
        'dob',
        'phone',
        'percentage',
        'nominee',
    ];
}
