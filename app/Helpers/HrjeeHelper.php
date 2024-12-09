<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

function removingSpaceMakingName($name)
{
    $lowerCaseName = strtolower($name);
    $finalName = str_replace(' ', '_', trim(preg_replace('/\s+/', ' ', $lowerCaseName)));
    return $finalName;
}

function unlinkFileOrImage($file)
{
    if (file_exists(storage_path('app/public') . $file)) {
        unlink(storage_path('app/public') . $file);
    }
    return true;
}

function uploadingImageorFile($file, String $path, $namePrefix = '')
{
    $image  = $namePrefix . '-' . time() . '.' . $file->getClientOriginalExtension();
    $path = $path . '/' . $image;
    Storage::disk('public')->put($path, file_get_contents($file));
    return  $path;
}


if (!function_exists('transLang')) {
    function transLang($template = null, $dataArr = [])
    {
        return $template ? trans("messages.{$template}", $dataArr) : '';
    }
}


if (!function_exists('uploadFile')) {
    function uploadFile($filename = false, $type = 'image', $path = '', $cdn = false)
    {
        $randomString = random_int(0, PHP_INT_MAX) . strtotime(now());

        $path = empty($path) ? 'originalImagePath' : $path;
        if ($cdn == true) {
            $s3 = Storage::disk('s3');
        }

        if (request()->$filename) {
            $mediaFile = request()->$filename;
            $filename = $randomString . '.' . $mediaFile->getClientOriginalExtension();
            if ($type == 'image') {
                if ($cdn == true) {
                    $imagePath = imagePath($filename);
                    $response = $s3->put($imagePath, file_get_contents($mediaFile), 'public');
                } else {
                    $imagePath = imagePath('', $path);
                    $response = $mediaFile->move($imagePath, $filename);
                }
                if ($response) {
                    return $filename;
                }
            }
        }


        return null;
    }
}

if (!function_exists('imagePath')) {
    function imagePath($filename = '', $path = '')
    {
        $path = empty($path) ? 'originalImagePath' : $path;
        return config("cms.{$path}") . $filename;
    }
}

if (!function_exists('imageBasePath')) {
    function imageBasePath($filename = '', $path = '')
    {
        $path = empty($path) ? 'originalImagePath' : $path;
        return asset(config("cms.{$path}") . '/' . $filename);
    }
}


if (!function_exists('generateOtp')) {
    function generateOtp()
    {
        return rand(1000, 9999);
    }
}


if (!function_exists('exceptionErrorMessage')) {
    function exceptionErrorMessage($e, $throw_exception = false, $data = '')
    {

        Log::error($e);
        if (env('APP_DEBUG')) {
            return errorMessage($data, $e->getMessage(), true, $throw_exception);
        }
        return errorMessage($data, 'session_expire', false, $throw_exception);
    }
}

if (!function_exists('errorMessage')) {
    function errorMessage($data = '', $errors = '', $string = false, $throw_exception = false)
    {

        return response()->json([
            'message' => transLang('given_data_invalid'),
            'status' => false,
            'errors' =>  empty($errors) ? null : $errors,
            'data' =>   $data === 'null' ? null : $data
        ], 401);
    }
}

if (!function_exists('apiResponse')) {
    function apiResponse($template = 'success', $dataArr = null, $httpCode = 200)
    {
        Log::error($template);
        $output = new \stdClass;
        $output->message = transLang($template);
        $output->status = true;
        $output->data = $dataArr;
        return response()->json($output, $httpCode);
    }
}
function getTotalHour($startTime, $endTime)
{
    $time1 = new DateTime($startTime);
    $time2 = new DateTime($endTime);
    $time_diff = $time1->diff($time2);
    // echo $time_diff->h . ' hours';
    // echo $time_diff->i . ' minutes';
    // echo $time_diff->s . ' seconds';
    return  $time_diff->h . ' hours' . '  ' . $time_diff->i . ' minutes';
}


function getFormattedDate($date)
{
    return date('jS M Y', strtotime($date));
}
