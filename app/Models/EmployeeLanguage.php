<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLanguage extends Model
{
    use HasFactory;
    protected $table='employee_language';
    protected $fillable =['name','user_id','languages','read','write','speak'];
    protected $casts = [
        'languages' => 'array'
    ];
}
