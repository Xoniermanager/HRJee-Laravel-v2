<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'video_type', 'video_url', 'pdf_file', 'company_id', 'department_id', 'designation_id', 'created_by'];
    
}
