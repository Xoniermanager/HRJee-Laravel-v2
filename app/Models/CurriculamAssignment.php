<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CurriculamAssignment extends Model
{
    use HasFactory;
    protected $fillable = ['curriculam_id', 'question', 'option1', 'option2', 'option3', 'option4', 'file'];
    protected function file(): Attribute
    {
        return Attribute::make(
            get: fn($value) => url("storage" . $value)
        );
    }
}
