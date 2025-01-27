<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeType extends Model
{
    use HasFactory;

    const NEWJOINEE = '2';

    protected $fillable = [
        'name',
        'description',
        'status'
    ];
}
