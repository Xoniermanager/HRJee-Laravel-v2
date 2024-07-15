<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBreakHistory extends Model
{
    use HasFactory;

    protected $fillable = ['employee_attendance_id', 'break_type_id', 'start_time', 'end_time', 'comment'];
}
