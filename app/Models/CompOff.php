<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompOff extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'is_used', 'used_date', 'status', 'user_remark', 'admin_remark'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
