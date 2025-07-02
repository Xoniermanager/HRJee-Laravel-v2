<?php

namespace App\Models;

use App\Models\UserDetail;
use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CompanyConnector extends Model
{
    use HasFactory, CompanyScope;
    protected $table = 'connectors';
    protected $fillable = [
        'company_id',
        'created_by',
        'profession',
        'gender',
        'connector_name',
        'brand_name',
        'email',
        'msisdn',
        'bussiness_id',
        'connector_id',
        'pan_number',
        'company_name',
        'gst_in',
        'address',
        'pincode',
        'city',
        'state',
        'short_code',
        'comment',
        'status',
        'connector_level',
        'assigned_to',
        'uploaded_file',
        'document_type',
        'address_proof'
    ];
    // public function company()
    // {
    //     return $this->belongsTo(User::class, 'company_id', 'company_id');
    // }
    // app/Models/Connector.php

    // app/Models/CompanyConnector.php

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to')->with('details');
    }

    protected function addressProof(): Attribute
    {
        return Attribute::make(
            get: fn($value) => url("storage/" .  $value)
        );
    }
}
