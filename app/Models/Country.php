<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    
    use HasFactory;
    protected $table = 'countries';
    public static function getCountryNameById($id)
    {
        
        $country = self::find($id);

        return $country ? $country->name : 'Country not found';
    }
}
