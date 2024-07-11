<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\BranchServices;
use App\Http\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsService;
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function assignedNews(Request $request)
    {
        $data = $this->newsService->getAllAssignedNews($request);
        return apiResponse('news', $data);
    }
}
