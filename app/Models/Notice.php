<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Notice extends Model
{
    use HasFactory;

    protected $table = 'notices';
    protected $fillable = [
        'title',
        'description',
        'attachment', 
        'status',
        'created_by',
        'company_id',
    ];

    protected function attachment(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url("storage/" .  $value)
        );
    }
}
