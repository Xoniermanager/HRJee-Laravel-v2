<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBranch extends Model
{
    use HasFactory;
   protected $table = 'company_branches';
    protected $fillable = [
        'company_id',
        'name',
        'branch_type',
        'contact_no',
        'email',
        'hr_email',
        'address',
        'city',
        'pincode',
        'state',
        'country_id',
        'status',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
