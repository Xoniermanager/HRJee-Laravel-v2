<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'employee_type_id',
        'department_id',
        'designation_id',
        'company_branch_id',
        'role_id',
        'qualification_id',
        'offer_letter_id',
        'work_from_office',
        'exit_date',
        'official_mobile_no',
        'shift_id',
        'start_time'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function officeShift()
    {
        return $this->belongsTo(OfficeShift::class, 'shift_id', 'id');
    }
    public function designation()
    {
        return $this->belongsTo(Designations::class, 'designation_id', 'id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function employeeTypes()
    {
        return $this->belongsTo(EmployeeType::class, 'employee_type_id', 'id');
    }
    public function companyBranches()
    {
        return $this->belongsTo(CompanyBranch::class, 'company_branch_id', 'id');
    }
    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
    public function qualification()
    {
        return $this->belongsTo(Qualification::class, 'qualification_id');
    }
}
