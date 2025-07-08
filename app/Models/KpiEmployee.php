<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiEmployee extends Model
{
    protected $fillable = [
        'cycle_id',
        'category_id',
        'subject',
        'tgt',
        'description',
        'company_id',
        'created_by'
    ];

    public function kpiCategory()
    {
        return $this->belongsTo(KpiCategory::class, 'category_id');
    }
    public function kpiReviewCycle()
    {
        return $this->belongsTo(KpiReviewCycle::class, 'cycle_id');
    }

    public function branches()
    {
        return $this->belongsToMany(CompanyBranch::class, 'kpi_employee_branch');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'kpi_employee_department');
    }

    public function designations()
    {
        return $this->belongsToMany(Designations::class, 'kpi_employee_designation', 'kpi_employee_id', 'designation_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'kpi_employee_employee')->withPivot('achievement');
    }
}
