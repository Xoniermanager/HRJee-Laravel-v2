<?php

namespace App\Models;

use App\Models\Scopes\ManagerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompOff extends Model
{
    use HasFactory,ManagerScope;

    protected $fillable = ['user_id', 'date', 'is_used', 'used_date', 'status', 'user_remark', 'admin_remark'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
