<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBranch extends Model
{
    use HasFactory;
    protected $table = 'company_branches';
    protected $fillable = [
        'name',
        'type',
        'contact_no',
        'email',
        'hr_email',
        'address',
        'city',
        'pincode',
        'state_id',
        'country_id',
        'company_id',
        'status',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function state()
    {
        return $this->belongsTo(state::class);
    }
}
