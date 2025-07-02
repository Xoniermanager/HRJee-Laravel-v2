<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Loan extends Model
{
    use HasFactory;
    protected $fillable = ['status','lead_id', 'product', 'amount', 'tenure', 'is_identified', 'approximate_value', 'ownership', 'disposition_1', 'disposition_2', 'comment', 'sanctioned_amount', 'sanctioned_date', 'interest_rate', 'reason'];

    public function productName()
    {
        return $this->belongsTo(Product::class, 'product', 'id');
    }
}
