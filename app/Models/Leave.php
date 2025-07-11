<?php

namespace App\Models;

use App\Models\Scopes\ManagerScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leave extends Model
{
    use HasFactory,ManagerScope;

    protected $fillable = [
        'user_id','leave_applied_by','from','to','leave_type_id','leave_status_id','reason','is_half_day','from_half_day','to_half_day'
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
        return $this->hasMany(LeaveStatusLog::class,'leave_id','id');
    }
    public function managerAction()
    {
        return $this->hasMany(LeaveManagerUpdate::class,'leave_id','id');
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
