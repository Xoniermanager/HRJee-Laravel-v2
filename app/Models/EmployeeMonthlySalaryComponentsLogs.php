<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeMonthlySalaryComponentsLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'monthly_salary_id',
        'salary_component_id',
        'salary_component_name',
        'value',
        'is_taxable',
        'earning_or_deduction',
    ];
}
