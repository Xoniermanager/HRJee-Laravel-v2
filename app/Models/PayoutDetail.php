<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PayoutDetail extends Model
{
    use HasFactory;

    protected $table = 'payout_details';
    protected $fillable = [
        'connector_id',
        'bank_name',
        'branch_name',
        'account_holder',
        'account_number',
        'ifsc_code',
        'cancel_cheque',
        'created_by',
        'company_id',
        'status',
    ];

    protected function cancelCheque(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url("storage/" .  $value)
        );
    }
}
