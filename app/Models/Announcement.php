<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['admin_image'];
    public function getAdminImageAttribute()
    {
        return imageBasePath($this->image, 'originalAnnouncementImagePath');
    }
}
