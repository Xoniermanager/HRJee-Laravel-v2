<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;
    protected $fillable = ["user_id", "gender", "date_of_birth", "department_id", "designation_id", "manager_id", "gurdian_name", 'gurdian_contact',"company_id", "role_id", "aadhar_no", "country_id", "resume", "offer_letter","joining_letter","contract_document","exit_date","Salary"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
