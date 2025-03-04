<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeManager extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'manager_id'];
}
