<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'company_id', 'status', 'parent_id'];

    public function assets()
    {
        return $this->hasMany(Asset::class, 'asset_category_id', 'id');
    }
}
