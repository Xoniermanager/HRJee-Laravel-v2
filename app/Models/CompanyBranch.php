<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CompanyBranch extends Model
{
    use SoftDeletes;
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
    public function news() {
        return $this->belongsToMany(News::class);
    }
    
}
