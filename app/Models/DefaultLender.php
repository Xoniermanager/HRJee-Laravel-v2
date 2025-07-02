<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultLender extends Model
{
    use HasFactory;

    protected $table = 'default_lenders';
    protected $fillable = [
        'name', 
        'description',
        'status',
        'created_by',
        'company_id',
    ];

}
