<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $table = 'user_address';
    protected $fillable = [
        'address_type',
        'user_id',
        'address',
        'city',
        'state',
        'pin_code',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
