<?php

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\MenuRole;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
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

function uploadingImageorFile($file, string $path, $namePrefix = '')
{
    $image = $namePrefix . '-' . time() . '.' . $file->getClientOriginalExtension();
    $path = $path . '/' . $image;
    Storage::disk('public')->put($path, file_get_contents($file));
    return $path;
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
            'errors' => empty($errors) ? null : $errors,
            'data' => $data === 'null' ? null : $data
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

function getTotalWorkingHour($startTime, $endTime)
{
    $time1 = new DateTime($startTime);
    $time2 = new DateTime($endTime);
    $time_diff = $time1->diff($time2);
    return $time_diff->h . ' hours' . '  ' . $time_diff->i . ' minutes';
}


function getFormattedDate($date)
{
    return date('jS M Y', strtotime($date));
}

function getWorkDateFromate($joiningDate)
{
    if ($joiningDate) {
        $joiningDate = Carbon::createFromFormat('Y-m-d', $joiningDate);
        $currentDate = Carbon::now();
        $diff = $joiningDate->diff($currentDate);

        return $diff->format(' %y Years, %m Months, %d Days');
    } else {

        return $joiningDate;
    }
}

function fullMonthList()
{
    return [
        '1' => 'January',
        '2' => 'February',
        '3' => 'March',
        '4' => 'April',
        '5' => 'May',
        '6' => 'June',
        '7' => 'July',
        '8' => 'August',
        '9' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December'
    ];
}

/**
 * Encrypt the id and return the encrypted id
 */
function getEncryptId($id)
{
    if (!empty($id)) {
        return Crypt::encrypt($id);
    }
    return false;
}

/**
 * Decrypt the encrypted id and return the original id
 */
function getDecryptId($id)
{
    if (!empty($id)) {
        return Crypt::decrypt($id);
    }
    return false;
}

function getCompanyMenuHtml($companyId)
{
    $html = '';
    $user = Auth::user();
    $companyMenuIDs = [];

    if ($user->type == 'company' || session()->has('impersonation')) {
        $urlPrefix = 'company';
    } else {
        $urlPrefix = 'employee';
    }

    foreach ($user->menu as $menu) {
        // Check if the menu has children
        if ($menu->children && $menu->children->isNotEmpty()) {
            if ($menu->status == 1) {
                $html .= '<div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-5">
                                    ' . $menu->icon . '
                                </span>
                            </span>
                            <span class="menu-title">' . $menu->title . '</span>
                            <span class="menu-arrow"></span>
                        </span>';
            }


            // Iterate over the children
            foreach ($menu->children as $children) {
                if ($children->role == "company" && $children->status == 1) {
                    $url = "/$urlPrefix$children->slug";

                    $html .= '<div class="menu-sub menu-sub-accordion">
                            <div class="menu-item" data-url="' . $url . '">
                                <a class="menu-link" href="' . $url . '">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">' . $children->title . '</span>
                                </a>
                            </div>
                            </div>';
                }
            }

            $html .= '</div>';  // Close the menu-item (accordion)
        }
        if ($menu->parent_id == null && $menu->children->isEmpty()) {
            if ($menu->status == 1) {
                $url = "/$urlPrefix$menu->slug";

                // If no children, just a simple menu item
                $html .= '<div class="menu-item" data-url="' . $url . '">
                        <a class="menu-link" href="' . $url . '">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-5">
                                    ' . $menu->icon . '
                                </span>
                            </span>
                            <span class="menu-title">' . $menu->title . '</span>
                        </a>
                        </div>';
            }
        }
    }

    return $html;
}

function getEmployeeMenuHtml()
{
    $html = '';

    $companyAssignedMenuIds = MenuRole::where('role_id', auth()->user()->parent->role_id)->pluck('menu_id')->toArray();
    $childMenus = Menu::where(['status' => 1, 'role' => 'employee'])->where(function ($query) use ($companyAssignedMenuIds) {
        $query->whereIn('parent_id', $companyAssignedMenuIds)
            ->orWhere('parent_id', NULL);
    })->get();

    foreach ($childMenus as $menu) {
        // If no children, just a simple menu item
        $html .= '<div class="menu-item" data-url="' . $menu->slug . '">
                    <a class="menu-link" href="' . $menu->slug . '">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-5">
                                ' . $menu->icon . '
                            </span>
                        </span>
                        <span class="menu-title">' . $menu->title . '</span>
                    </a>
                    </div>';
    }

    return $html;
}
function numberToWords($num)
{
    $ones = array(
        0 => 'Zero',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine',
        10 => 'Ten',
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen'
    );
    $tens = array(
        2 => 'Twenty',
        3 => 'Thirty',
        4 => 'Forty',
        5 => 'Fifty',
        6 => 'Sixty',
        7 => 'Seventy',
        8 => 'Eighty',
        9 => 'Ninety'
    );
    $hundreds = array(
        1 => 'Hundred',
        1000 => 'Thousand',
        1000000 => 'Million',
        1000000000 => 'Billion'
    );

    if ($num == 0) {
        return $ones[0];
    }

    $result = '';

    if ($num >= 1000) {
        $result .= numberToWords(intval($num / 1000)) . ' ' . $hundreds[1000] . ' ';
        $num = $num % 1000;
    }

    if ($num >= 100) {
        $result .= $ones[intval($num / 100)] . ' ' . $hundreds[1] . ' ';
        $num = $num % 100;
    }

    if ($num >= 20) {
        $result .= $tens[intval($num / 10)] . ' ';
        $num = $num % 10;
    }

    if ($num > 0) {
        $result .= $ones[$num];
    }

    return $result;
}
