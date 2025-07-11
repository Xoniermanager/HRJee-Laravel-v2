<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $table = 'supports';
    protected $fillable = [
        'user_id', 'company_id','status', 'created_by', 'remark', 'comment', 'subject'
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
