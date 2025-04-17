<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardCategory extends Model
{
    use HasFactory,CompanyScope;
    protected $fillable = ['name', 'description', 'status','company_id','created_by'];
}
