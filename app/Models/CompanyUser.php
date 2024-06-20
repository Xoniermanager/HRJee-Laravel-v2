<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class CompanyUser extends Authenticatable
{
    use HasFactory;
    protected $table = 'company_users';
    public function getAuthPassword()
    {
        return $this->password;
    }
}
