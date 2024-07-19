<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\BranchServices;
use App\Http\Services\NewsService;
use Illuminate\Http\Request;
use Throwable;

class NewsController extends Controller
{
    protected $newsService;
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function assignedNews(Request $request)
    {
        try {
            $user = auth()->guard('employee_api')->user();
            $data = $this->newsService->getAllAssignedNews($request, $user);
            return apiResponse('news', $data);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
