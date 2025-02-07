<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxSlabRule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'income_range_start',
        'income_range_end',
        'tax_rate',
        'company_id',
        'created_by',
        'status'
    ];
}
