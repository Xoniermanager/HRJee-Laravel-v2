<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PRMCategory extends Model
{
    use HasFactory;
    protected $table = "prm_categories";

    protected $fillable =['name','status','company_id', 'created_by'];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucfirst($value),
        );
    }
}
