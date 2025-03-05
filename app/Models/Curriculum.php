<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Curriculum extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title', 'instructor', 'short_description', 'content_type', 'url', 'has_assignment'];
    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->content_type == "pdf" ? url("storage" . $value) : $value
        );
    }
}
