<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBankDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'account_name',
        'account_number',
        'bank_name',
        'ifsc_code',
        'pan_no',
        'uan_no',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
