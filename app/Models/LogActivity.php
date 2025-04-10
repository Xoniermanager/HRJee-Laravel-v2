<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'method', 'ip', 'response_code', 'response_body', 'request_body', 'user_id', 'user_name','user_type','company_id'];
}
