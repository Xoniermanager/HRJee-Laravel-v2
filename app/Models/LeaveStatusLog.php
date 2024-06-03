<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveStatusLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_id', 'action_taken_by', 'leave_status_id', 'remarks'
    ];
    public function leaveStatus()
    {
        return $this->belongsTo(LeaveStatus::class);
    }
    public function leave()
    {
        return $this->belongsTo(Leave::class);
    }
}
