<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankerProduct extends Model
{
    use HasFactory;

    protected $table = 'banker_products';
    protected $fillable = [
        'product_id', 
        'status',
        'loan_product_id',
        'listing_order',
        'created_by',
        'company_id',
    ];
}
