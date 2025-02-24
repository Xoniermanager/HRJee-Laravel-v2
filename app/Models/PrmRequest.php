<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrmRequest extends Model
{
    use HasFactory;
    protected $table = "prm_requests";

    protected $fillable =['user_id','category_id','amount','document','status','bill_date','remark'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(PRMCategory::class);
    }

}
