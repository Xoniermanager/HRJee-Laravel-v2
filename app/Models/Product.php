<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 
        'status',
        'loan_product_id',
        'listing_order',
        'created_by',
        'company_id',
    ];

    public function lender()
    {
        return $this->hasMany(Lender::class, 'product_id');
    }
}
