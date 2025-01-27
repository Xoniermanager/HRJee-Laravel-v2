<?php

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\CompanyMenu;
use Illuminate\Support\Facades\Log;
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

function getTotalWorkingHour($startTime, $endTime)
{
    $time1 = new DateTime($startTime);
    $time2 = new DateTime($endTime);
    $time_diff = $time1->diff($time2);
    return  $time_diff->h . ' hours' . '  ' . $time_diff->i . ' minutes';
}


function getFormattedDate($date)
{
    return date('jS M Y', strtotime($date));
}

function getWorkDateFromate($joiningDate)
{
    $joiningDate = Carbon::createFromFormat('Y-m-d', $joiningDate);
    $currentDate = Carbon::now();
    $diff = $joiningDate->diff($currentDate);
    return $diff->format(' %y Years, %m Months, %d Days');
}

function fullMonthList()
{
    return  [
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
    $companyMenus = [];
    $html = '';

    if (session()->has('impersonation')) {
        $roleID = session()->get('impersonation')['original_user_role'];
        $companyMenuSql = CompanyMenu::with(['menu' => function ($query) {
            $query->where('status', 1);
            $query->orderBy('order_no', 'ASC');
        }, 'menu.parent'])->where('role_id', $roleID);
    } else {
        $companyMenuSql = CompanyMenu::with(['menu' => function ($query) {
            $query->where('status', 1);
            $query->orderBy('order_no', 'ASC');
        }, 'menu.parent'])->where('company_id', $companyId);
    }

    $companyMenuIDs = $companyMenuSql->pluck('menu_id')->toArray();
    $companyMenus = $companyMenuSql->get();
    foreach ($companyMenus as $companyMenu) {
        $menu = $companyMenu->menu;
        $companyMenuIDs[] = $menu->parent_id;
    }

    $companyMenus = Menu::where('status', 1)->whereIn('id', $companyMenuIDs)->orderBy('order_no', 'ASC')->get();

    foreach ($companyMenus as $menu) {
        // Check if the menu has children
        if ($menu->children && $menu->children->isNotEmpty()) {
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

            // Iterate over the children
            foreach ($menu->children as $children) {
                if (in_array($children->id, $companyMenuIDs)) {
                    $html .= '<div class="menu-sub menu-sub-accordion">
                            <div class="menu-item" data-url="' . $children->slug . '">
                                <a class="menu-link" href="' . $children->slug . '">
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
    }

    return $html;
}

function getEmployeeMenuHtml($companyId)
{
    $companyMenus = [];
    $html = '';

    $companyMenuSql = Menu::where(['status' => 1, 'role' => 'employee']);
    $mainMenuIDs = $companyMenuSql->whereNull('parent_id')->pluck('id')->toArray();

    $companyAssignedMenuIds = CompanyMenu::where('company_id', $companyId)->pluck('menu_id')->toArray();

    $childMenuIDs = $companyMenuSql->whereIn('parent_id', $companyAssignedMenuIds)->whereNotNull('parent_id')->pluck('id')->toArray();
    $parentMenuIDs = $companyMenuSql->whereIn('parent_id', $companyAssignedMenuIds)->whereNotNull('parent_id')->pluck('parent_id')->toArray();

    $parentMenus = array_merge($mainMenuIDs, $parentMenuIDs);
    $companyMenus = Menu::whereIn('id', $parentMenus)->orderBy('order_no', 'ASC')->with(['parent'])->get();

    foreach ($companyMenus as $menu) {
        // Check if the menu has children
        if ($menu->children && $menu->children->isNotEmpty()) {
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

            // Iterate over the children
            foreach ($menu->children as $children) {
                if (in_array($children->id, $childMenuIDs)) {
                    $html .= '<div class="menu-sub menu-sub-accordion">
                            <div class="menu-item" data-url="' . $children->slug . '">
                                <a class="menu-link" href="' . $children->slug . '">
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

    }

    return $html;
}
