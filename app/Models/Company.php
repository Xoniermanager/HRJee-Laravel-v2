<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'companies';
    protected $fillable = [
        'name',
        'username',
        'contact_no',
        'email',
        'password',
        'role_id',
        'joining_date',
        'logo',
        'company_size',
        'company_url',
        'industry_type',
        'company_address',
        'subscription_id',
        'status',
    ];

    /**
     * Automatically hash the password when setting it.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Get the password for the company.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
    protected function logo(): Attribute   
    {
        return Attribute::make(
            get: fn(string $value) =>  url("storage/" . $value),
        );
    }

    public function branches()
    {
        return $this->hasMany(CompanyBranch::class);
        
    }

}
