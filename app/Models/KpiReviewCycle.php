<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiReviewCycle extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'type', 'start_date', 'end_date','status'];
}
