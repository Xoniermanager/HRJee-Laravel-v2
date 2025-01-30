<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'company_id',
        'manager_id',
        'type',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function menu()
    {
        return $this->role->belongsToMany(Menu::class)->with(['children']);
    }

    public function menus()
    {
        if($this->role_id) {
            $menusIDs = MenuRole::where('role_id', $this->role_id)->pluck('menu_id')->toArray();

            return Menu::whereIn('id', $menusIDs)->with(['children'])->get()->toArray();
        } else {

            return [];
        }
    }

    public function details()
    {
        if($this->type == "user") {
            return $this->hasOne(UserDetail::class, 'user_id');
        } else {
            return $this->hasOne(CompanyDetail::class, 'user_id');
        }
        
    }
    public function companyDetails()
    {
        return $this->hasOne(CompanyDetail::class, 'user_id');
    }

    public function addressDetails()
    {
        return $this->hasMany(UserAddressDetail::class, 'user_id');
    }

    public function bankDetails()
    {
        return $this->hasOne(UserBankDetail::class, 'user_id');
    }

    public function advanceDetails()
    {
        return $this->hasOne(UserAdvanceDetail::class, 'user_id');
    }

    public function pastWorkDetails()
    {
        return $this->hasMany(UserPastWorkDetail::class, 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'company_id');
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

    protected function profileImage(): Attribute
    {
        return Attribute::make(
            get: fn($value) => url("storage" . $value)
        );
    }

    public function skill()
    {
        return $this->belongsToMany(Skill::class, 'user_skill', 'user_id', 'skill_id');
    }

    public function language()
    {
        return $this->belongsToMany(Languages::class, 'langauge_user', 'user_id', 'language_id')->withPivot('read', 'write', 'speak');
    }

    public function assetDetails()
    {
        return $this->hasMany(UserAsset::class, 'user_id', 'id')->where('returned_date', '=', null);
    }

    public function hasPermission($permissionName)
    {
        return $this->role->permissions()->where('name', $permissionName)->exists();
    }

    public function resignationLogs()
    {
        return $this->morphMany(ResignationLog::class, 'actionTakenBy');
    }
}
