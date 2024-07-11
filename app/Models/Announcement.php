<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function designations()
    {
        return $this->belongsToMany(Designations::class, 'announcement_designation', 'announcement_id', 'designation_id');
    }
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'announcement_department', 'announcement_id', 'department_id');
    }
    public function companyBranches()
    {
        return $this->belongsToMany(CompanyBranch::class, 'announcement_company_branch', 'announcement_id', 'company_branch_id');
    }
}
