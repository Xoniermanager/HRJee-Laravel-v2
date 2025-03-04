<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMonthlySalaryComponentsLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'monthly_salary_id',
        'component_id',
        'name',
        'monthly',
        'type',
    ];
}
