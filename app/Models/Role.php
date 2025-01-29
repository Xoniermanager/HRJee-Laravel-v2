<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    const ADMIN = '1';
    const USER = '2';

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'category',
        'created_by',
        'deleted_at',
        'status'
    ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_role')
            ->withPivot('can_create', 'can_read', 'can_update', 'can_delete')
            ->withTimestamps();
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
