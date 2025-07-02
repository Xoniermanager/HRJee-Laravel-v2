<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncentivePayment extends Model
{
    use HasFactory;

    protected $table = 'incentive_payments';
    protected $fillable = [
        'connector_id',
        'incentive_type',
        'amount',
        'month',
        'status',
        'created_by',
        'company_id',
    ];

    public function connector()
    {
        return $this->belongsTo(CompanyConnector::class, 'connector_id', 'id');
    }
}
