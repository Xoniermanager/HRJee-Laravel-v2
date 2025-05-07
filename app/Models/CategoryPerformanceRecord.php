<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPerformanceRecord extends Model
{
    use HasFactory;

    protected $fillable = ['performance_management_id', 'performance_category_id', 'performance'];

    
}
