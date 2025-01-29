<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResignationStatus extends Model
{
    use HasFactory,CompanyScope;

    protected $table = 'resignation_status';
    protected $guarded = ['id'];
    


    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
