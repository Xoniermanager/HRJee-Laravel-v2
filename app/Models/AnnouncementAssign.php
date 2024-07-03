<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementAssign extends Model
{
    use HasFactory;

    protected $table = 'announcement_assignes';
    protected $guarded = ['id'];
}
