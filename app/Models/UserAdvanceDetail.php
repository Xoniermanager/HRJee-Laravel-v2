<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdvanceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'aadhar_no',
        'pan_no',
        'uan_no',
        'esic_no',
        'pf_no',
        'insurance_no',
        'driving_licence_no',
        'probation_period',
        'ctc_value',
        'salary_id'
    ];
    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }
}
