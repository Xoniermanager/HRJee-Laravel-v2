<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Policy extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'image', 'policy_category_id', 'start_date', 'end_date', 'description', 'file', 'designation_id', 'department_id', 'news_category_id', 'company_branch_id', 'status'];

    public function designations()
    {
        return $this->belongsToMany(Designations::class, 'designation_policy', 'policy_id', 'designation_id');
    }
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_policy', 'policy_id', 'department_id');
    }
    public function companyBranches()
    {
        return $this->belongsToMany(CompanyBranch::class, 'company_branch_policy', 'policy_id', 'company_branch_id');
    }
    public function policyCategories()
    {
        return $this->belongsTo(PolicyCategory::class, 'policy_category_id');
    }
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url("storage/" .  $value)
        );
    }
    protected function file(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url("storage/" .  $value)
        );
    }
}
