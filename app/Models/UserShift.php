<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserShift extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'shift_id',
        'shift_day'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function shift()
    {
        return $this->belongsTo(OfficeShift::class, 'shift_id', 'id');
    }
}
