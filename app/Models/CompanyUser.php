<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyUser extends Authenticatable
{
    use SoftDeletes;
    protected $table = 'company_users';
    protected $fillable = ['company_id','branch_id','email','name','password','status'];
}
