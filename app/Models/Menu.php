<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'parent_id',
        'slug',
        'status',
        'icon',
        'order_no',
        'role'
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order_no', 'asc');
    }

    public function company()
    {
        return $this->belongsToMany(Company::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menu_role')
            ->withPivot('can_create', 'can_read', 'can_update', 'can_delete')
            ->withTimestamps();
    }
}
