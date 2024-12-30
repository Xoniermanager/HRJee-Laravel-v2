<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignHolidayBranches extends Model
{
    use HasFactory;
    protected $fillable = [
        'holiday_id',
        'company_branch_id'
    ];
}
