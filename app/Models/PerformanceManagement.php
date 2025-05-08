<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceManagement extends Model
{
    use HasFactory;

    protected $fillable = ['cycle_id', 'company_id', 'user_id', 'start_date', 'end_date', 'leave_ranking', 'attendance_ranking', 'task_ranking', 'is_approved', 'created_by'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categoryRecords()
    {
        return $this->hasMany(CategoryPerformanceRecord::class, 'performance_management_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(PerformanceReview::class, 'performance_management_id', 'id');
    }
}
