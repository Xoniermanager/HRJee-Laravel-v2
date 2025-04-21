<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Weekend extends Model
{
    use HasFactory, CompanyScope;
    protected $fillable = ['company_branch_id', 'description', 'status', 'company_id','department_id','created_by', 'weekend_dates', 'designation_id'];


    protected $casts = [
        'weekend_days' => 'array', // Automatically convert JSON to array
    ];

    public function companyBranch()
    {
        return $this->belongsTo(CompanyBranch::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    protected function weekendDates(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => json_decode($value),
        );
    }
}
