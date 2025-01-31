<?php

namespace App\Models;

use App\Observers\CompanyObserver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'username',
        'contact_no',
        'email',
        'password',
        'joining_date',
        'logo',
        'company_size',
        'company_url',
        'subscription_id',
        'company_address',
        'subscription_id',
        'status',
        'company_type_id'
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
    public function menu()
    {
        return $this->belongsToMany(Menu::class);
    }
    public function companyType()
    {
        return $this->belongsTo(CompanyType::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function employeeAttendances()
    {
        return $this->hasManyThrough(EmployeeAttendance::class, User::class);
    }
}
