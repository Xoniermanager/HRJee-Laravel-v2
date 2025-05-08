<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'company_id', 'status', 'created_by'
    ];
}
