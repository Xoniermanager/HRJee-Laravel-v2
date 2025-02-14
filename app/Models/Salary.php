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
    public function createSalaryComponentAssignment($salaryComponentsId)
    {
        SalaryComponentAssignment::where('salary_id', $this->id)->delete();
        foreach ($salaryComponentsId as $key => $item) {
            $item['salary_id'] = $this->id;
            $item['salary_component_id'] = $key;
            $item['company_id'] = $this->company_id;
            $item['created_by'] = $this->created_by;
            SalaryComponentAssignment::create(Arr::except($item, ['id']));
        }
    }

    public function salaryComponentAssignments()
    {
        return $this->hasMany(SalaryComponentAssignment::class);
    }
}
