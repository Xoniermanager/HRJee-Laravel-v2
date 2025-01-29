<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetCategory extends Model
{
    use HasFactory, CompanyScope;
    protected $fillable = ['name', 'company_id', 'status', 'parent_id', 'created_by'];

    public function assets()
    {
        return $this->hasMany(Asset::class, 'asset_category_id', 'id');
    }
}
