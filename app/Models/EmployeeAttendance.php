<?php

namespace App\Models;

use App\Models\Scopes\ManagerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    use HasFactory, ManagerScope;

    protected $fillable =
    [
        'user_id',
        'punch_in',
        'punch_out',
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
        'is_short_attendance',
        'punch_in_latitude',
        'punch_in_longitude',
        'punch_out_latitude',
        'punch_out_longitude',
        'punch_in_address',
        'punch_out_address',
        'is_auto_punch_out',
        'shift_id',
        'shift_start_time',
        'shift_end_time'
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
