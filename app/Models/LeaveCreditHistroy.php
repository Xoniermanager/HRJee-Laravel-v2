<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveCreditHistroy extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','leave_credit_management_id'];
}
