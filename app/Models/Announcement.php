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
}
