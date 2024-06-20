<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


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
        return $this->hasMany(UserAddressDetail::class, 'user_id');
    }

    public function advanceDetails()
    {
        return $this->hasOne(UserAdvanceDetail::class, 'user_id');
    }

    public function pastWorkDetails()
    {
        return $this->hasMany(UserPastWorkDetail::class, 'user_id');
    }

    public function documentDetails()
    {
        return $this->hasMany(UserDocumentDetail::class, 'user_id');
    }
    public function qualificationDetails()
    {
        return $this->hasMany(UserQualificationDetail::class, 'user_id', 'id');
    }
    public function familyDetails()
    {
        return $this->hasMany(UserRelativeDetail::class, 'user_id', 'id');
    }

    public function userDetails()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'id');
    }

    protected function profileImage(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url("storage/" .  $value)
        );
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skill', 'user_id', 'skill_id');
    }

    public function languages()
    {
        return $this->belongsToMany(Languages::class, 'langauge_user', 'user_id', 'language_id')->withPivot('read', 'write', 'speak');
    }
    public function employeeStatus()
    {
        return $this->belongsTo(EmployeeStatus::class, 'employee_status_id', 'id');
    }
}
