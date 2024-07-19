<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplainStatus extends Model
{
    use HasFactory;
    const APPROVED = '1';
    const PENDING = '2';
    const REJECTED = '3';
    const PROCESSING = '4';

    protected $fillable = ['name', 'status', 'company_id'];
}
