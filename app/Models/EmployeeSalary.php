<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'salary_id',
        'ctc_value',
    ];

    /**
     * Get employee salary
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get assigned salary structure
     */
    public function salaryStructure()
    {
        return $this->belongsTo(Salary::class, 'salary_id', 'id');
    }
}
