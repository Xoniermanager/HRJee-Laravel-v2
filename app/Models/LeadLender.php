<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadLender extends Model
{
    use HasFactory;
    protected $table = "lead_lenders";
    protected $fillable = [
        
        'lead_id',
        'company_id',
        'created_by',
        'lender_id',
        'purpose',
        'getting_eligibility_passed',
        'score',
        'max_loan_amount',
        'total_emi',
        'tenure',
        'roi',
    ];
    public function leadLender()
    {
        return $this->belongsTo(Lender::class, 'lender_id', 'id')->with('lender');
    }
}
