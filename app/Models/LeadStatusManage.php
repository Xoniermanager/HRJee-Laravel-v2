<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class LeadStatusManage extends Model
{
    use HasFactory, CompanyScope;
    protected $table = "leads_status_manage";
    protected $fillable = [
        'status',
        'lead_id',
        'lead_state',
        'lead_sub_state',
        'lead_next_sub_state',
        'comment',
        'company_id',
        'created_by'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
