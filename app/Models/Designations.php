<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Designations extends Model
{
    use HasFactory, CompanyScope;
    protected $table = 'designations';
    protected $fillable = [
        'name',
        'company_id',
        'department_id',
        'created_by',
        'status'
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
        );
    }

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function news()
    {
        return $this->belongsToMany(News::class);
    }
}

