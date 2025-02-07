<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalaryHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_salary_id',
        'salary_id',
        'ctc_value',
        'start_date',
        'end_date',
        'change_details',
        'changed_by'
    ];

    /**
     * Get the employee to whom this salary log belongs to
     */
    public function employeeSalary()
    {
        return $this->belongsTo(employeeSalary::class,'employee_salary_id','id');
    }

    /**
     * Get the salary structure details
    */
    public function salary()
    {
        return $this->belongsTo(Salary::class, 'salary_id', 'id');
    }
}
