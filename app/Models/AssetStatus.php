<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetStatus extends Model
{
    use HasFactory,CompanyScope;

    const CREATED = '1';
    const UPDATED = '2';
    protected $fillable = ['name', 'company_id','status','created_by'];

}
