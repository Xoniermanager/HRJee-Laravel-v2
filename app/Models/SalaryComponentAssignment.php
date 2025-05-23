<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryComponentAssignment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'salary_id',
        'salary_component_id',
        'value',
        'is_taxable',
        'value_type',
        'parent_component',
        'earning_or_deduction',
        'created_by',
        'company_id'
    ];

    /**
     * Get salary component details
     */
    public function salaryComponent()
    {
        return $this->belongsTo(salaryComponent::class, 'salary_component_id', 'id');
    }

    /**
     * Get parent salary component details
     */
    public function parentSalaryComponent()
    {
        return $this->belongsTo(salaryComponent::class, 'parent_component', 'id');
    }

    /**
     * Get salary details
     */
    public function salary()
    {
        return $this->belongsTo(Salary::class, 'salary_id', 'id');
    }
}
