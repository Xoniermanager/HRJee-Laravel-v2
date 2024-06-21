<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class CompanyUser extends Authenticatable
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'company_users';
    protected $guarded = ['id'];
    // public function getAuthPassword()
    // {
    //     return $this->password;
    // }
}
