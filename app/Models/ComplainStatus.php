<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplainStatus extends Model
{
    use HasFactory, CompanyScope;
    const APPROVED = '1';
    const PENDING = '2';
    const REJECTED = '3';
    const PROCESSING = '4';

    protected $fillable = ['name', 'status', 'company_id', 'created_by'];
}
