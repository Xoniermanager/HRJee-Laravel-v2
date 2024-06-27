<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQualificationDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'institute',
        'university',
        'course',
        'year',
        'percentage',
        'qualification_id',
    ];

    public function qualification()
    {
        return $this->belongsTo(Qualification::class, 'qualification_id');
    }
}
