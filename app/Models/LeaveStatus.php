<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveStatus extends Model
{
    use HasFactory;

    const PENDING = '1';
    const APPROVED = '2';
    
    protected $fillable = [
        'name', 'status','company_id'
    ];
}
