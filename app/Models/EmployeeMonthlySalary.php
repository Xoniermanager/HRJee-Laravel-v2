<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeMonthlySalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_salary_id',
        'salary_month',
        'salary_year',
        'total_salary',
        'in_hand_salary',
        'total_deductions',
        'tax_rate',
    ];
}
