<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'video_type', 'video_url', 'pdf_file', 'company_id', 'department_id', 'designation_id', 'created_by','status'];


    public function designation()
    {
        return $this->belongsTo(Designations::class, 'designation_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function curriculums()
    {
        return $this->hasMany(Curriculum::class);
    }

    protected function pdfFile(): Attribute
    {
        return Attribute::make(
            get: fn($value) => url("storage" . $value)
        );
    }
}
