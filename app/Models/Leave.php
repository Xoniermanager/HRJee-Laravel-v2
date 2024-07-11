<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id','leave_applied_by','from','to','leave_type_id','leave_status_id','reason','Is_half_day','from_half_day','to_half_day'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function leaveAppliedBy()
    {
        return $this->belongsTo(User::class,'leave_applied_by','id');
    }
    public function leaveAction()
    {
        return $this->hasOne(LeaveStatusLog::class,'leave_id','id');
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }
    public function leaveStatus()
    {
        return $this->belongsTo(LeaveStatus::class);
    }
    protected function getLeaveTypeNameAttribute()
    {
        return LeaveType::where('id', $this->getAttributes()['leave_type_id'])->pluck('name')->first();
    }
}
