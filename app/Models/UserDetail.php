<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'emp_id',
        'official_email_id',
        'father_name',
        'mother_name',
        'blood_group',
        'gender',
        'marital_status',
        'employee_status_id',
        'date_of_birth',
        'joining_date',
        'phone',
        'profile_image',
        'last_login_ip',
        'employee_type_id',
        'department_id',
        'designation_id',
        'company_branch_id',
        'qualification_id',
        'offer_letter_id',
        'work_from_office',
        'exit_date',
        'official_mobile_no',
        'shift_id',
        'start_time',
        'status',
        'face_recognition',
        'face_kyc',
        'face_punchin_kyc',
        'location_tracking',
        'live_location_active',
    ];

    protected function profileImage(): Attribute
    {
        return Attribute::make(
            get: fn($value) => url("storage" . $value)
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function employeeStatus()
    {
        return $this->belongsTo(EmployeeStatus::class, 'employee_status_id', 'id');
    }

    public function designation()
    {
        return $this->belongsTo(Designations::class, 'designation_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function employeeType()
    {
        return $this->belongsTo(EmployeeType::class, 'employee_type_id', 'id');
    }

    public function officeShift()
    {
        return $this->belongsTo(OfficeShift::class, 'shift_id', 'id');
    }

    public function companyBranch()
    {
        return $this->belongsTo(CompanyBranch::class, 'company_branch_id', 'id');
    }

    public function qualification()
    {
        return $this->belongsTo(Qualification::class, 'qualification_id');
    }

}
