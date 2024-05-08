<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $fillable = [
            'name','company_id'
    ];
    public function designations() 
    {
        return $this->hasMany(Designations::class);
    }
}
