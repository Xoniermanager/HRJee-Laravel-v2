<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResignationStatus extends Model
{
    use HasFactory;
    protected $table = 'resignation_status';
    protected $guarded = ['id'];


    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
