<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplainCategory extends Model
{
    use HasFactory,CompanyScope;
    protected $fillable = ['name', 'status', 'company_id', 'description','created_by'];
}
