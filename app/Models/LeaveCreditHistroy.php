<?php

namespace App\Models;

use App\Models\Scopes\ManagerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveCreditHistroy extends Model
{
    use HasFactory,ManagerScope;

    protected $fillable = ['user_id','leave_credit_management_id'];
}
