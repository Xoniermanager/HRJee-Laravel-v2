<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CoApplicant extends Model
{
    use HasFactory;
    protected $table = 'co_applicants';

    protected $fillable = ['applicant_type', 'business_type', 'email', 'pan', 'incorporation_date', 'no_of_years', 'business_profile', 'pincode', 'address', 'country', 'city', 'state', 'disposition_1', 'disposition_2', 'comment', 'number', 'name', 'status', 'lead_id', 'reg_pincode', 'reg_address', 'reg_country', 'reg_city', 'reg_state',];

   
}
