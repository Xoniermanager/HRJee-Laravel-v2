<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewCycleUser extends Model
{
    use HasFactory;

    protected $fillable = ['performance_review_cycle_id', 'user_id'];

    
}
