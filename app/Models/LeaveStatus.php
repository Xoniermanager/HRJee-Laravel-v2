<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveStatus extends Model
{
    use HasFactory;

    const PENDING = '1';
    const APPROVED = '2';

    const CANCELLED = '3';
    const REJECTED = '3';

    protected $fillable = [
        'name', 'status', 'company_id','created_by'
    ];
}
