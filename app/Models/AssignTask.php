<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignTask extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'user_end_status', 'final_status', 'response_data', 'company_id', 'created_by','document','image','disposition_code_id'];
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
            get: fn($value) => url("storage" . $value)
        );
    }
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($value) => url("storage" . $value)
        );
    }
}
