<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveManagerUpdate extends Model
{
    use HasFactory;

    protected $fillable = ['manager_id', 'leave_id', 'leave_status_id', 'remark'];

    public function manager()
    {
        return $this->belongsTo(User::class,'manager_id','id');
    }
}
