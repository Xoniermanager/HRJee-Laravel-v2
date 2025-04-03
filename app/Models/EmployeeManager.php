<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeManager extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'manager_id'];

    // Get the Employee Details
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    // Get the manager details
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
