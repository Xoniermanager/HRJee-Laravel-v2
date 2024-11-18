<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'company_id', 'asset_category_id', 'asset_manufacturer_id', 'asset_status_id', 'model', 'ownership', 'purchase_value', 'depreciation_per_year', 'invoice_no', 'invoice_date', 'serial_no', 'invoice_file', 'allocation_status', 'validation_upto', 'company_id'];
    protected $appends = [
        'user_name',
        'email',
        'assigned_date',
        'returned_date',
        'comment',
        'asset_category',
        'asset_manu_facturer',
        'assets_status'

    ];
    protected $hidden = [
        'user_name',
        'email',
        'assigned_date',
        'returned_date',
        'comment',
        'asset_category',
        'asset_manu_facturer',
        'assets_status'
    ];
    public function assetManufacturers()
    {
        return $this->belongsTo(AssetManufacturer::class, 'asset_manufacturer_id', 'id');
    }
    public function assetCategories()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id', 'id');
    }
    public function assetStatus()
    {
        return $this->belongsTo(AssetStatus::class, 'asset_status_id', 'id');
    }
    public function userAsset()
    {
        return $this->hasOne(UserAsset::class, 'asset_id', 'id');
    }

    public function getAssignedDateAttribute()
    {
        if ($this->relationLoaded('userAsset')) {
            return  !empty($this->userAsset) ? $this->userAsset->assigned_date : '';
        }
        return ""; // Or handle as needed
    }
    public function getReturnedDateAttribute()
    {
        if ($this->relationLoaded('userAsset')) {
            return   !empty($this->userAsset) ? (!empty($this->userAsset->returned_date) ? $this->userAsset->returned_date : '') : '';
        }
        return ""; // Or handle as needed
    }
    public function getCommentAttribute()
    {
        if ($this->relationLoaded('userAsset')) {
            return   !empty($this->userAsset) ? (!empty($this->userAsset->comment) ? $this->userAsset->comment : '') : '';
        }
        return ""; // Or handle as needed
    }
    public function getUserNameAttribute()
    {
        if ($this->relationLoaded('userAsset')) {
            return   !empty($this->userAsset->user) ? $this->userAsset->user->name : '';
        }
        return ""; // Or handle as needed
    }

    public function getEmailAttribute()
    {
        if ($this->relationLoaded('userAsset')) {
            return   !empty($this->userAsset->user) ? $this->userAsset->user->email : '';
        }
        return ''; // Or handle as needed
    }
    public function getAssetCategoryAttribute()
    {
        if ($this->relationLoaded('assetCategories')) {
            return   !empty($this->assetCategories) ? $this->assetCategories->name : '';
        }
        return ''; // Or handle as needed
    }
    public function getAssetManuFacturerAttribute()
    {
        if ($this->relationLoaded('assetManufacturers')) {
            return  !empty($this->assetManufacturers) ? $this->assetManufacturers->name : '';
        }
        return ''; // Or handle as needed
    }
    
    public function getAssetsStatusAttribute()
    {
        if ($this->relationLoaded('assetStatus')) {
            return  !empty($this->assetStatus) ? $this->assetStatus->name : '';
        }
        return ''; // Or handle as needed
    }
   
}
