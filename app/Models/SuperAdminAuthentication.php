<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Use this base class


class SuperAdminAuthentication extends Authenticatable
{
    use HasFactory;
    
    protected $table = 'admin';
    
    protected $fillable =  ['name','username','email','password','role_id','contact_no','status'];
}
