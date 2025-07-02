<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class IncomeDetail extends Model
{
    use HasFactory;
    protected $fillable = ['status','lead_id', 'latest_turnover', 'previous_turnover', 'latest_profit', 'previous_profit', 'total_loan_outstanding', 'total_current_monthly_emi', 'comment', 'is_coapplicant'];

}
