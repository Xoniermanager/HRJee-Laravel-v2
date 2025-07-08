<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceReviewCycle extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'title', 'start_date', 'end_date', 'department_id', 'created_by', 'company_branch_id', 'designation_id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'review_cycle_users', 'performance_review_cycle_id', 'user_id')
            ->withTimestamps();
    }

    public function userList()
    {
        $users = [];

        foreach ($this->users as $value) {
            $users[] = $value->user_id;
        }

        return $users;
    }
}
