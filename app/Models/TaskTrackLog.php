<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTrackLog extends Model
{
    use HasFactory,CompanyScope;
    protected $fillable = ['user_id','assign_task_id','from_status','to_status','company_id','created_by','response_data'];
}
