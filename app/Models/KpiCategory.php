<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'created_by',
        'status'
    ];
}
