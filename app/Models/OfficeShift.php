<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeShift extends Model
{
    use HasFactory, CompanyScope;

    protected $table = 'shifts';
    protected $fillable = [
        'company_id',
        'created_by',
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
        'login_before_shift_time',
        'total_late_count',
        'total_leave_deduction',
    ];

    public function officeTimingConfigs()
    {
        return $this->belongsTo(OfficeTimingConfig::class, 'office_timing_config_id', 'id');
    }
}
