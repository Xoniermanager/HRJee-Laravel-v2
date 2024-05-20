<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'official_mobile_no'
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}
