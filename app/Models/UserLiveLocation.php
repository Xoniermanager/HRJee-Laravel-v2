<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLiveLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'latitude',
        'longitude',
        'read',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
