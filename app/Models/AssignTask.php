<?php

namespace App\Models;

use App\Models\Scopes\ManagerScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignTask extends Model
{
    use HasFactory,ManagerScope;
    protected $fillable = ['user_id', 'user_end_status', 'final_status', 'response_data', 'company_id', 'created_by', 'document', 'image', 'disposition_code_id', 'remark', 'visit_address', 'longitude', 'latitude', 'visit_address_latitude', 'visit_address_longitude', 'completed_at'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function dispositionCode()
    {
        return $this->belongsTo(DispositionCode::class);
    }
    protected function document(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? url("storage" . $value) : ''
        );
    }
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? url("storage" . $value) : ''
        );
    }
    protected static function booted()
    {
        parent::booted();

        static::created(function ($assignedTask) {
            $assignedTask->handlePostCreationActions();
        });
        static::updated(function ($assignedTask) {
            $assignedTask->handlePostUpdatedActions();
        });
    }

    public function handlePostCreationActions()
    {
        $payload = [
            'user_id' => $this->user_id,
            'assign_task_id' => $this->id,
            'from_status' => $this->user_end_status,
            'to_status' => $this->user_end_status,
            'response_data' => $this->response_data,
            'company_id' => Auth()->user()->company_id,
            'created_by' => Auth()->user()->id,
        ];
        TaskTrackLog::create($payload);
    }
    public function handlePostUpdatedActions()
    {
        $payload = [
            'user_id' => $this->user_id,
            'assign_task_id' => $this->id,
            'from_status' => $this->user_end_status,
            'to_status' => $this->user_end_status,
            'response_data' => $this->response_data,
            'company_id' => Auth()->user()->company_id,
            'created_by' => Auth()->user()->id,
        ];
        TaskTrackLog::create($payload);
    }
}
