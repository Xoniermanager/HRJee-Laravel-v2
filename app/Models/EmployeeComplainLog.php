<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeComplainLog extends Model
{
    use HasFactory;

    protected $fillable = ['employee_complain_id', 'from_id', 'to_id', 'message', 'status'];
}
