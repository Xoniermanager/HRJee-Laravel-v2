<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveCreditManagement extends Model
{
    use HasFactory,CompanyScope;

    protected $fillable = ['company_branch_id', 'employee_type_id', 'repeat_in_months', 'minimum_working_days_if_month', 'credit_leave_on_day', 'leave_type_id', 'number_of_leaves', 'status', 'company_id', 'created_by'];

    public function companyBranches()
    {
        return $this->belongsTo(CompanyBranch::class, 'company_branch_id', 'id');
    }
    public function employeeTypes()
    {
        return $this->belongsTo(EmployeeType::class, 'employee_type_id', 'id');
    }
    public function leaveTypes()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id', 'id');
    }
}
