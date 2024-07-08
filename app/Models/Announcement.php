<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $appends = ['announcement_image'];
    public function getAnnouncementImageAttribute()
    {
        return imageBasePath($this->image, 'originalAnnouncementImagePath');
    }

    public function branches()
    {
        return $this->belongsToMany(CompanyBranch::class, 'announcement_branch', 'announcement_id', 'branch_id');
    }
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'announcement_department', 'announcement_id', 'department_id');
    }
    public function designations()
    {
        return $this->belongsToMany(Designations::class, 'announcement_designation', 'announcement_id', 'designation_id');
    }

    public function scopeActive($query) {
        return $query->where('status', 'active');
    }
}
