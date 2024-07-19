<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeComplainStatusLog extends Model
{
    use HasFactory;

    protected $fillable = ['employee_complain_id_complain_id', 'hr_login_id', 'current_status_id', 'new_status_id'];
}
