<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeTimingConfig extends Model
{
    use HasFactory, CompanyScope;

    protected $table = 'office_timing_configs';
    protected $fillable = [
        'name',
        'shift_hours',
        'company_branch_id',
        'half_day_hours',
        'min_shift_Hours',
        'min_half_day_hours',
        'company_id',
        'created_by',
    ];
    
    public function companyBranch()
    {
        return $this->belongsTo(CompanyBranch::class, 'company_branch_id', 'id');
    }
}
