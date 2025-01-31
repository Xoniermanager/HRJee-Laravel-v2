<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeComplain extends Model
{
    use HasFactory;

    protected $fillable = ['complain_category_id', 'complain_status_id', 'description', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function complainStatus()
    {
        return $this->belongsTo(ComplainStatus::class);
    }
    public function complainCategory()
    {
        return $this->belongsTo(ComplainCategory::class);
    }
}
