<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeTimingConfig extends Model
{
    use HasFactory;

    protected $table = 'office_timing_configs';
    protected $fillable = [
        'name', 'shift_hours', 'company_branch', 'half_day_hours', 'min_shift_Hours', 'min_half_day_hours',
    ];
}
