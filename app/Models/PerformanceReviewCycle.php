<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceReviewCycle extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'title', 'start_date', 'end_date', 'department_id', 'created_by'];

    public function users()
    {
        return $this->hasMany(ReviewCycleUser::class, 'performance_review_cycle_id', 'id');
    }

    public function userList() {
        $users = [];

        foreach ($this->users as $value) {
            $users[] = $value->user_id;
        }

        return $users;
    }
}
