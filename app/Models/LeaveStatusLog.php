<?php

namespace App\Models;

use App\Models\Scopes\ManagerScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaveStatusLog extends Model
{
    use HasFactory,ManagerScope;

    protected $fillable = [
        'leave_id', 'action_taken_by', 'leave_status_id', 'remarks'
    ];
    public function leaveStatus()
    {
        return $this->belongsTo(LeaveStatus::class);
    }
    public function actionTakenBy()
    {
        return $this->belongsTo(User::class,'action_taken_by','id');
    }
    public function leave()
    {
        return $this->belongsTo(Leave::class);
    }
}
