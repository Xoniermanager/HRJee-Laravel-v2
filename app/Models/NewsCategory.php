<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;

    protected $fillable =['name','status','company_id'];

    public function news() {
        return $this->hasOne(News::class);
    }
}
