<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceManagement extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'user_id', 'start_date', 'end_date', 'leave_ranking', 'attendance_ranking', 'task_ranking', 'manager_review', 'hr_review', 'is_approved'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
