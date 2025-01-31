<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CompanyBranch extends Model
{
    use SoftDeletes;
    use HasFactory, CompanyScope;
    protected $table = 'company_branches';
    protected $fillable = [
        'name',
        'type',
        'contact_no',
        'email',
        'hr_email',
        'address',
        'city',
        'pincode',
        'state_id',
        'country_id',
        'company_id',
        'status',
        'created_by',
        'description'
    ];
    public function company()
    {
        return $this->belongsTo(User::class, 'company_id', 'company_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function state()
    {
        return $this->belongsTo(state::class);
    }
    public function news()
    {
        return $this->belongsToMany(News::class);
    }

    public function announcements()
    {
        return $this->belongsToMany(Announcement::class, 'announcement_branch', 'branch_id', 'announcement_id');
    }
}
