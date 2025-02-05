<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salary extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'company_id',
        'created_by',
        'status'
    ];

    protected static function booted()
    {
        parent::booted();
        static::created(function ($entry) {
            $entry->handlePostCreationActions();
        });
    }

    public function handlePostCreationActions()
    {
        $defaultSalaryComponents = SalaryComponent::where('company_id', $this->company_id)
            ->where('created_by', $this->created_by)
            ->where('is_default', true)
            ->get();

        foreach ($defaultSalaryComponents as $defaultSalaryComponent) {
            $data = $defaultSalaryComponent->toArray();
            $data['value'] = $defaultSalaryComponent->default_value;
            $data['salary_id'] = $this->id;
            $data['salary_component_id'] = $defaultSalaryComponent->id;
            SalaryComponentAssignment::create(Arr::except($data, ['id', 'name']));
        }
    }

    public function salaryComponentAssignment()
    {
        return $this->belongsTo(SalaryComponentAssignment::class,'salary_id','');
    }
}
