<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyMenu extends Model
{
    use HasFactory;

    protected $table = 'company_menu';
    protected $fillable = ['company_id', 'name', 'status'];

    public function role()
    {
        return $this->belongsTo(CustomRole::class, 'role_id', 'id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
