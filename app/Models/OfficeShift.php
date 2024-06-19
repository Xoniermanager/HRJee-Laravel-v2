<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeShift extends Model
{
    use HasFactory;

    protected $table = 'shifts';
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'check_in_buffer',
        'check_out_buffer',
        'min_late_count',
        'early_checkout_count',
        'half_day_login',
        'status',
        'is_default',
        'office_timing_config_id',
        'apply_late_count',
        'apply_early_checkout_count',
        'lock_attendance',
        'login_before_shift_time'
    ];

    public function officeTimingConfigs()
    {
        return $this->belongsTo(OfficeTimingConfig::class, 'office_timing_config_id', 'id');
    }
}
