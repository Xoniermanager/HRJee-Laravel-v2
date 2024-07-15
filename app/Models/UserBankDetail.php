<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBankDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'account_name',
        'account_number',
        'bank_name',
        'ifsc_code',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    
}
