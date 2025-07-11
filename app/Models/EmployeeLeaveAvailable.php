<?php

namespace App\Models;

use App\Models\Scopes\ManagerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveAvailable extends Model
{
    use HasFactory, ManagerScope;

    protected $fillable = ['user_id','leave_type_id','available'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }
}
