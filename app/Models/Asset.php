<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'company_id', 'asset_category_id', 'asset_manufacturer_id', 'asset_status_id', 'model', 'ownership', 'purchase_value', 'depreciation_per_year', 'invoice_no', 'invoice_date', 'serial_no', 'invoice_file', 'allocation_status', 'validation_upto', 'company_id'];

    public function assetManufacturers()
    {
        return $this->belongsTo(AssetManufacturer::class,'asset_manufacturer_id','id');
    }
    public function assetCategories()
    {
        return $this->belongsTo(AssetCategory::class,'asset_category_id','id');
    }
    public function userAsset()
    {
        return $this->hasOne(UserAsset::class,'asset_id','id');
    }
}
