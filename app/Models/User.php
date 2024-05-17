<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'emp_id',
        'name',
        'email',
        'password',
        'official_email_id',
        'father_name',
        'mother_name',
        'blood_group',
        'gender',
        'marital_status',
        'employee_status_id',
        'date_of_birth',
        'joining_date',
        'phone',
        'profile_image',
        'company_id',
        'last_login_ip'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function bankDetails()
    {
        return $this->hasOne(UserBankDetail::class, 'user_id');
    }

    public function addressDetails()
    {
        return $this->hasOne(UserAddressDetail::class, 'user_id');
    }

    public function advanceDetails()
    {
        return $this->hasOne(UserAdvanceDetail::class, 'user_id');
    }

    public function pastWorkDetails()
    {
        return $this->hasOne(UserPastWorkDetail::class, 'user_id');
    }

    public function documentDetails()
    {
        return $this->hasOne(UserDocumentDetail::class, 'user_id');
    }
    public function qualificationDetails()
    {
        return $this->hasMany(UserQualificationDetail::class, 'user_id','id');
    }
}
