<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';
    protected $fillable = [
        'title',
        'description',
        'web_offer_image', 
        'status',
        'created_by',
        'company_id',
    ];

    protected function webOfferImage(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url("storage/" .  $value)
        );
    }
}
