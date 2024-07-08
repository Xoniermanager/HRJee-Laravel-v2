<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveManagement extends Model
{
    use HasFactory;
    protected $fillable = ['credit', 'debit', 'available', 'employee_leave_available_id', 'mode'];
}
