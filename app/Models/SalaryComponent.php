<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryComponent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'default_value',
        'is_taxable',
        'value_type',
        'parent_component',
        'is_default',
        'earning_or_deduction',
        'company_id',
        'created_by',
        'status'
    ];

    /**
     * Get parent component details
     */
    public function parentSalaryComponent()
    {
        return $this->belongsTo(SalaryComponent::class, 'parent_component', 'id');
    }
}
