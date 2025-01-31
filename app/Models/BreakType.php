<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakType extends Model
{
    use HasFactory, CompanyScope;

    protected $fillable = ['name', 'description', 'company_id', 'status', 'created_by'];
}
