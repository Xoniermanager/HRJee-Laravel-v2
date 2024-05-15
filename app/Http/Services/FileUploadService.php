<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Storage;


class FileUploadService
{
    public function __construct(){
        
    }
    public function imageUpload($file,String $path, $namePrefix=''){
        $image  = $namePrefix . '-' . time() . '.' . $file->getClientOriginalExtension();
        $path = $path . '/' . $image;
        Storage::disk('public')->put($path, file_get_contents($file));  
       return  $path;
    }
}