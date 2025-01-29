<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weekend extends Model
{
    use HasFactory;
    protected $fillable = ['company_branch_id', 'description', 'status', 'company_id','department_id','created_by'];
    public function companyBranch()
    {
        return $this->belongsTo(CompanyBranch::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function weekday()
    {
        return $this->belongsToMany(WeekDay::class, 'week_day_weekend', 'weekend_id', 'week_day_id');
    }
}
