<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory, CompanyScope;

    protected $fillable = [
        'company_branch_id',
        'name',
        'date',
        'year',
        'company_id',
        'status',
        'created_by'
    ];
    public function companyBranch()
    {
        return $this->belongsToMany(CompanyBranch::class, 'company_branch_holiday', 'holiday_id', 'company_branch_id');
    }
}
