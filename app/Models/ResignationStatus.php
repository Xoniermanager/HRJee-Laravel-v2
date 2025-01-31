<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResignationStatus extends Model
{
    use HasFactory;

    protected $table = 'resignation_status';
    protected $guarded = ['id'];
    
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
        );
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
