<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use App\Models\CoApplicant;
use App\Models\Loan;
use App\Models\IncomeDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Lead extends Model
{
    use HasFactory, CompanyScope;
    protected $fillable = ['status', 'lead_state', 'lead_sub_state', 'company_id', 'created_by', 'lead_type', 'connector_name', 'applicant_type', 'business_type', 'customer_number', 'customer_name', 'assigned_user', 'assigned_back_office', 'know_product', 'case_id', 'email', 'pan', 'incorporation_date', 'no_of_years', 'business_profile', 'pincode', 'address', 'country', 'city', 'state', 'disposition_1', 'disposition_2', 'comment', 'reg_pincode', 'reg_address', 'reg_country', 'reg_city', 'reg_state',
];

    public function coApplicants()
    {
        return $this->hasOne(CoApplicant::class);
    }

    public function loan()
    {
        return $this->hasOne(Loan::class)->with('productName');
    }

    public function connector()
    {
        return $this->belongsTo(CompanyConnector::class, 'connector_name', 'connector_id');
    }

    public function incomeDetails()
    {
        return $this->hasOne(IncomeDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_user')->with('details');
    }
    
    public function selectedLenders()
    {
        return $this->hasOne(LeadLender::class, 'lead_id')->with('leadLender');
    }
}
