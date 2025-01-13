<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class companyMenuPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'company_id',
        'created_at',
        'updated_at'
    ];
}
