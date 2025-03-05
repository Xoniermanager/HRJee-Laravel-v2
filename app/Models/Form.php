<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'company_id', 'created_by'];

    public function formfield()
    {
        return $this->hasMany(FormField::class);
    }
}
