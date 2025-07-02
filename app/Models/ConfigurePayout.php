<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigurePayout extends Model
{
    use HasFactory;
    protected $table = "configure_payouts";
    protected $fillable = [
        'connector_id',
        'company_id',
        'created_by',
        'product_id',
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
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function lead()
    {
        return $this->hasOne(Lead::class, 'connector_name', 'connector_id')->with('connector');
    }

    public function loan()
    {
        return $this->hasOne(Loan::class, 'product', 'product_id');
    }
}
