<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'user_id',
        'punch_in',
        'punch_out',
        'latitude',
        'longitude',
        'punch_in_using',
        'punch_in_by',
        'work_from',
        'attendance_status_id',
        'jiofence_auto_check_in',
        'jiofence_auto_check_out',
        'total_break_time',
        'late',
        'status',
        'remark',
        'company_id',
        'created_by',
        'is_short_attendance'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
