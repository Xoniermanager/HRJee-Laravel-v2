<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAsset extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'asset_id', 'assigned_date', 'returned_date', 'comment'];
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
