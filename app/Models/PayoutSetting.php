<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutSetting extends Model
{
    use HasFactory;
    protected $table = "payout_settings";
    protected $fillable = [
        'company_id',
        'created_by',
        'product_id',
        'lender_id',
        'payout_type',
        'payout_structure',
        'minimum_slab',
        'maximum_slab',
        'payout_as',
        'amount',
        'sub_payout_type',
        'fixed_amount',
        'effective_from',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function lender()
    {
        return $this->belongsTo(DefaultLender::class, 'lender_id');
    }
}
