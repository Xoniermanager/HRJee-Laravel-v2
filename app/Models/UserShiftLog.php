<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserShiftLog extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'shift_id', 'date'];
    public function officeShift()
    {
        return $this->belongsTo(OfficeShift::class, 'shift_id', 'id');
    }
}
