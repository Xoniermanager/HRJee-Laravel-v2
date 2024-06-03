<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class UserDocumentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'document_type_id',
        'document'
    ];

    public function documentTypes()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id', 'id');
    }
    protected function document(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url("storage/" .  $value)
        );
    }
}
