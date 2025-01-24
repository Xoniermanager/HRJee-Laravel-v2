<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;


class RoleHasMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'menu_id' 
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
