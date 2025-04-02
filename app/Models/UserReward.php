<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserReward extends Model
{
    use HasFactory;
    protected $fillable = ['reward_category_id','user_id','reward_name','description','date','image','document','company_id','created_by'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function rewardCategory()
    {
        return $this->belongsTo(RewardCategory::class);
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
