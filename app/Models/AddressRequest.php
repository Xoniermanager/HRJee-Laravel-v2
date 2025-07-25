<?php

namespace App\Models;

use App\Models\Scopes\ManagerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressRequest extends Model
{
    use HasFactory,ManagerScope;
    protected $fillable = ['user_id', 'address', 'latitude', 'longitude', 'status', 'company_id', 'created_by','reason'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
