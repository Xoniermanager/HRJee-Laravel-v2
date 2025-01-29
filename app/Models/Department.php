<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'company_id',
        'created_by'
    ];

    public function departments()
    {
        return $this->hasOne(Department::class);

    }
    public function news()
    {
        return $this->belongsToMany(News::class);
    }
}
