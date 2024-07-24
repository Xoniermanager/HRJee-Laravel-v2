<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }
    public function index()
    {
        $allAssinedNewsDetails = $this->newsService->getAllAssignedNewsForEmployee();
        return view('employee.news.index', compact('allAssinedNewsDetails'));
    }

    public function viewDetails($id)
    {
        $newsDetails = $this->newsService->findByNewsId($id);
        return view('employee.news.details', compact('newsDetails'));
    }
}
