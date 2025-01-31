<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Http\Services\NewsService;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    protected $newsService;
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function allAssignedNews()
    {
        try {
            $allAssignedNews = $this->newsService->getAllAssignedNewsForEmployee();
            $assinedNews = [];
            foreach ($allAssignedNews as $assignedNews) {
                $assinedNews[] =
                    [
                        'id' => $assignedNews->id,
                        'date' =>  date('j F,Y', strtotime($assignedNews->start_date)),
                        'title' => $assignedNews->title,
                        'image' => $assignedNews->image,
                        'news_Category' => $assignedNews->newsCategories->name
                    ];
            }
            return response()->json([
                'status' => true,
                'message' => 'Retried News List Successfully',
                'data' => $assinedNews,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function viewNewsDetails($id)
    {
        try {
            $newsDetails = $this->newsService->findByNewsId($id);
            $viewNewsDetails =
                [
                    'date' =>  date('j F,Y', strtotime($newsDetails->start_date)),
                    'title' => $newsDetails->title,
                    'image' => $newsDetails->image,
                    'news_Category' => $newsDetails->newsCategories->name,
                    'description' => $newsDetails->description,
                    'file' => $newsDetails->file
                ];
            return response()->json([
                'status' => true,
                'message' => 'Retried News Details Successfully',
                'data' => $viewNewsDetails,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
