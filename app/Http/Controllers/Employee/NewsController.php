<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsService;
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }
    public function index(Request $request)
    {
        $user = auth()->guard('employee')->user();
        $data = $this->newsService->getAllAssignedNews($request, $user);
        return view('employee.news.index', compact('data'));
    }

    public function viewDetails(Request $request)
    {
        $news = $this->newsService->findByNewsId($request->id);
        // $user = auth()->guard('employee')->user();
        // $data = $this->newsService->getAllAssignedNews($);
        return view('employee.news.details',compact('news'));
    }
}
