<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRMCategory extends Model
{
    use HasFactory;
    protected $table = "prm_categories";

    protected $fillable =['name','status','company_id'];
}
