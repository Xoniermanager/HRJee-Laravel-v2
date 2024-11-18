<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResignationLog extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $hidden = ['resignation_status_id','resignation_id'];
    public function actionTakenBy()
    {
        return $this->belongsTo(User::class, 'action_taken_by', 'id');
    }
    public function resignationStatus()
    {
        return $this->belongsTo(ResignationStatus::class, 'resignation_status_id', 'id');
    }
}
