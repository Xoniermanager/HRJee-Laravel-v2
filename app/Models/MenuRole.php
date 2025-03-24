<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuRole extends Model
{
    use HasFactory;

    protected $table = 'menu_role';
    protected $fillable = ['menu_id', 'role_id', 'can_create', 'can_read', 'can_update', 'can_delete'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
