<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddressDetail extends Model
{
    use HasFactory;
    protected $table = 'user_addresses_details';
    protected $fillable = [
        'address_type',
        'user_id',
        'address',
        'city',
        'state_id',
        'country_id',
        'pin_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
