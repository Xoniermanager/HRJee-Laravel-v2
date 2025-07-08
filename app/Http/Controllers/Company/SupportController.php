<?php

namespace App\Http\Controllers\Company;


use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\SupportService;

use function Clue\StreamFilter\remove;

class SupportController extends Controller
{
    protected $supportService;

    public function __construct(SupportService $supportService)
    {
        $this->supportService = $supportService;
    }

    public function index()
    {
        $allSupports = $this->supportService->all();
        return view('company.support.index', compact('allSupports'));
    }


    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:supports,id',
        ]);

        $id = $request->id;

        try {
            $support = $this->supportService->deleteDetails($id);
            if ($support) {
                return response()->json([
                    'status' => true,
                    'message' => 'Support deleted successfully!',
                    'data' => view('company.support.list', [
                        'allSupports' => $this->supportService->all(),
                    ])->render()
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to delete support. Please try again.',
                    'data' => null,
                ], 500);
            }
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function reply(Request $request)
    {
        try {

            $id = $request->id;
            $payload = $request->except(['_token', 'id']);
            $support = $this->supportService->changeStatus($id, $payload);

            if ($support) {
                return response()->json([
                    'status' => true,
                    'message' => 'Replied Successfully!',
                    'data' => view('company.support.list', [
                        'allSupports' => $this->supportService->all(),
                    ])->render()
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Something Went Wrong!',
                    'data' => null,
                ], 500);
            }
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
