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
            'department_id',
            'company_id'
    ];

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}

