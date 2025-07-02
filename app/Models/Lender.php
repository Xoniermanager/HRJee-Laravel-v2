<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lender extends Model
{
    use HasFactory;

    protected $table = 'lenders';
    protected $fillable = [
        'product_id', 
        'lender_name', 
        'consent_type',
        'individual_case_routing',
        'bulk_case_routing',
        'hub',
        'pincode',
        'city',
        'lender_link', 
        'status',
        'created_by',
        'company_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function lender()
    {
        return $this->belongsTo(DefaultLender::class, 'lender_name', 'id');
    }
}
