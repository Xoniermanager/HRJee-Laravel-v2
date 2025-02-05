<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Department extends Model
{
    use HasFactory, CompanyScope;

    protected $fillable = [
        'name',
        'status',
        'company_id',
        'created_by'
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
        );
    }

    public function departments()
    {
        return $this->hasOne(Department::class);

    }
    public function news()
    {
        return $this->belongsToMany(News::class);
    }
}
