<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;
    protected $fillable = ['course_id', 'title', 'instructor', 'short_description', 'content_type', 'video_url', 'pdf_file', 'has_assignment', 'company_id', 'created_by'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function curriculamAssignment()
    {
        return $this->hasMany(CurriculamAssignment::class, 'curriculam_id', 'id');
    }
}
