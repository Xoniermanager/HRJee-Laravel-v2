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

    protected $appends = [
        'branch',
        'designation',
        'department',
        'official_mobile_no',
        'bank_name',
        'account_name',
        'account_number',
        'ifsc_code',
        'permanent_address',
        'permanent_city',
        'local_address',
        'local_city',
        'permanent_country',
        'local_country',
        'permanent_state',
        'local_state',
    ];
    protected $guarded = ['id'];
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
        'branch',
        'designation',
        'department',
        'official_mobile_no',
        'bank_name',
        'account_name',
        'account_number',
        'ifsc_code',
        'permanent_address',
        'permanent_city',
        'local_address',
        'local_city',
        'permanent_country',
        'local_country',
        'permanent_state',
        'local_state',
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


    public function getBranchAttribute()
    {
        if ($this->relationLoaded('userDetails')) {
            return  isset($this->userDetails->companyBranches) && !empty($this->userDetails->companyBranches) ? $this->userDetails->companyBranches->name : null;
        }
        return null; // Or handle as needed
    }
    // employee bank name
    public function getBankNameAttribute()
    {
        if ($this->relationLoaded('bankDetails')  && !empty($this->bankDetails)) {
            return  isset($this->bankDetails) && !empty($this->bankDetails) ? $this->bankDetails->bank_name : null;
        }
        return 'default bank'; // Or handle as needed
    }
    // employee bank name
    public function getIfscCodeAttribute()
    {
        if ($this->relationLoaded('bankDetails')  && !empty($this->bankDetails)) {
            return  isset($this->bankDetails) && !empty($this->bankDetails) ? $this->bankDetails->ifsc_code : null;
        }
        return 'default ifsc code'; // Or handle as needed
    }
    // employee bank account name
    public function getAccountNameAttribute()
    {
        if ($this->relationLoaded('bankDetails')  && !empty($this->bankDetails)) {
            return  isset($this->bankDetails) && !empty($this->bankDetails) ? $this->bankDetails->account_name : null;
        }
        return 'default account name'; // Or handle as needed
    }
    // employee bank account number
    public function getAccountNumberAttribute()
    {
        if ($this->relationLoaded('bankDetails')  && !empty($this->bankDetails)) {
            return  isset($this->bankDetails) && !empty($this->bankDetails) ? $this->bankDetails->account_number : null;
        }
        return 'default account number'; // Or handle as needed
    }
    public function getDesignationAttribute()
    {
        if ($this->relationLoaded('userDetails')) {
            return  isset($this->userDetails->designation) && !empty($this->userDetails->designation) ? $this->userDetails->designation->name : null;
        }
        return null; // Or handle as needed
    }
    public function getDepartmentAttribute()
    {
        if ($this->relationLoaded('userDetails')) {
            $userDepartment = $this->userDetails->department;
            return  isset($userDepartment) && !empty($userDepartment) ? $userDepartment->name : null;
        }
        return null; // Or handle as needed
    }
    public function getOfficialMobileNoAttribute()
    {
        if ($this->relationLoaded('userDetails')) {
            $userDetails = $this->userDetails;
            return  isset($userDetails) && !empty($userDetails) ? $userDetails->official_mobile_no : null;
        }
        return null; // Or handle as needed
    }
    public function getShiftAttribute()
    {
        if ($this->relationLoaded('userDetails')) {
            $shift = $this->userDetails->officeShift;
            return  isset($shift) && !empty($shift) ? date('h:i A', strtotime($shift->start_time)) . " " . date('h:i A', strtotime($shift->end_time)) : null;
        }
        return null; // Or handle as needed
    }
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
        return $this->hasMany(UserDocumentDetail::class, 'user_id', 'id');
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
    public function assetDetails()
    {
        return $this->hasMany(UserAsset::class, 'user_id', 'id')->where('returned_date', '=', null);
    }
    // employee permanent address
    public function getPermanentAddressAttribute()
    {
        if ($this->relationLoaded('addressDetails') && $this->addressDetails->isNotEmpty()) {
            $address = $this->addressDetails->whereIn('address_type', ['permanent','both_same'])->first();
            return  isset($address) && !empty($address) ? $address->city : null;
        }
        return 'Default City'; // Default value if relation is not loaded or does not exist

    }
    // employee permanent city
    public function getPermanentCityAttribute()
    {
        if ($this->relationLoaded('addressDetails') && $this->addressDetails->isNotEmpty()) {
            $address = $this->addressDetails->whereIn('address_type', ['permanent','both_same'])->first();
            return  isset($address) && !empty($address) ? $address->city : null;
            // return  isset($this->addressDetails) && !empty($this->addressDetails) ? $this->addressDetails->city : null;
        }
        return 'Default City'; 
    }
    // employee local
    public function getLocalAddressAttribute()
    {
        if ($this->relationLoaded('addressDetails') && $this->addressDetails->isNotEmpty()) {
            $address = $this->addressDetails->whereIn('address_type', ['local','both_same'])->first();
            return  isset($address) && !empty($address) ? $address->address : null;
        }
        return 'Default City'; 
    }

    // employee permanent address
    public function getLocalCityAttribute()
    {
        if ($this->relationLoaded('addressDetails') && $this->addressDetails->isNotEmpty()) {

            $address = $this->addressDetails->whereIn('address_type', ['local','both_same'])->first();
            return  isset($address) && !empty($address) ? $address->city : null;
        }
        return 'Default City'; 
    }
    // employee permanent country
    public function getPermanentCountryAttribute()
    {
        if ($this->relationLoaded('addressDetails') && $this->addressDetails->isNotEmpty()) {
            $address = $this->addressDetails->whereIn('address_type', ['permanent','both_same'])->first();
            return  isset($address->country) && !empty($address->country) ? $address->country->name : null;
        }
        return 'Default City'; 
    }

    public function getLocalCountryAttribute()
    {
        if ($this->relationLoaded('addressDetails') && $this->addressDetails->isNotEmpty()) {
            $address = $this->addressDetails->whereIn('address_type', ['local','both_same'])->first();
            return  isset($address->country) && !empty($address->country) ? $address->country->name : null;
        }
        return 'Default City'; 
    }
    public function getPermanentStateAttribute()
    {
        if ($this->relationLoaded('addressDetails') && $this->addressDetails->isNotEmpty()) {
            $address = $this->addressDetails->whereIn('address_type', ['permanent','both_same'])->first();
            return  isset($address->state) && !empty($address->state) ? $address->state->name : null;
        }
        return 'Default City'; 
    }

    public function  getLocalStateAttribute()
    {
        if ($this->relationLoaded('addressDetails') && $this->addressDetails->isNotEmpty()) {
            $address = $this->addressDetails->whereIn('address_type', ['local','both_same'])->first();
            return  isset($address->state) && !empty($address->state) ? $address->state->name : null;
        }
        return 'Default state'; 
    }
}
