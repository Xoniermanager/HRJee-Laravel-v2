<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxSlabRule extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'income_range_start',
        'income_range_end',
        'tax_rate',
    ];
}
