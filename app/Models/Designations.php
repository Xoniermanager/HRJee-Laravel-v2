<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designations extends Model
{
    use HasFactory;
    protected $table = 'designations';
    protected $fillable = [
            'name',
            'company_id',
            'department_id',
            'status'
    ];

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function news() {
        return $this->belongsToMany(News::class);
    }
}

