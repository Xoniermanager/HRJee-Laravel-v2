<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceRequest extends Model
{
    use HasFactory,CompanyScope;
    protected $fillable = ['user_id', 'date', 'punch_in', 'punch_out', 'reason', 'status', 'company_id', 'created_by'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
