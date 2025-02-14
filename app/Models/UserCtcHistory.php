<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCtcHistory extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','ctc_value','effective_date','salary_id'];

    public function userCtcComponentHistory()
    {
        return $this->hasMany(UserCtcComponentHistory::class);
    }
    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }
}
