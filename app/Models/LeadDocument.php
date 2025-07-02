<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadDocument extends Model
{
    use HasFactory;
    protected $table = "lead_documents";
    protected $fillable = [
        'lead_id',
        'document_type',
        'document_sub_type',
        'file',
        'company_id',
        'created_by'
    ];
}
