<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPastWorkDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'previous_company_id',
        'designation',
        'from',
        'to',
        'duration',
        'current_company',
    ];

    public function previousCompanies()
    {
        return $this->belongsTo(PreviousCompany::class, 'previous_company_id');
    }
}
