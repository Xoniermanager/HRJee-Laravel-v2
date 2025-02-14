<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMonthlySalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'month',
        'year',
        'monthly_earnings',
        'monthly_deductions',
        'monthlyTaxValue',
        'totalLossOfPayAmount',
        'total_working_days',
        'loss_of_pay_days',
        'salary_calculated_for_days',
        'monthly_ctc',
        'mail_send'
    ];

    public function userMonthlySalaryComponentLog()
    {
        return $this->hasMany(UserMonthlySalaryComponentsLog::class, 'monthly_salary_id', 'id');
    }
}
