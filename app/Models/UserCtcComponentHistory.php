<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCtcComponentHistory extends Model
{
    use HasFactory;
    protected $fillable = ['user_ctc_history_id', 'salary_component_id', 'value', 'value_type', 'parent_component', 'earning_or_deduction'];
    public function salaryComponent()
    {
        return $this->belongsTo(SalaryComponent::class);
    }
}
