<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title','image','news_category_id','start_date','end_date','description','file','designation_id','department_id','news_category_id','comapany_branch_id'];

    public function designations()
    {
        return $this->belongsToMany(Designations::class);
    }
    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }
    public function companyBranches()
    {
        return $this->belongsToMany(CompanyBranch::class);
    }
    public function newsCategories()
    {
        return $this->hasOne(NewsCategory::class);
    }
}
