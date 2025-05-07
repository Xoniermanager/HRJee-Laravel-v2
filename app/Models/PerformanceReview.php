<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceReview extends Model
{
    use HasFactory;

    protected $fillable = ['performance_management_id', 'manager_id', 'review'];

    public function performanceManagement()
    {
        return $this->belongsTo(PerformanceManagement::class, 'performance_management_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }
}
