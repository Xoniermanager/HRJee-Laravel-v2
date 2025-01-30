<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyDetail extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $fillable = [
        'username',
        'contact_no',
        'password',
        'joining_date',
        'logo',
        'company_size',
        'company_url',
        'subscription_id',
        'company_address',
        'subscription_id',
        'status',
        'company_type_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function companyType()
    {
        return $this->belongsTo(CompanyType::class);
    }

    public function branches()
    {
        return $this->hasMany(CompanyBranch::class, 'company_id', 'user_id');
    }
}
