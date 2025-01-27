<?php

namespace App\Jobs;

use App\Mail\EmployeeAssetFileSend;
use App\Exports\EmployeeAssetExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Exception;

class EmployeeAssetExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $companyName;
    protected $companyEmail;
    protected $allEmployeeAssetDetails;

    // Constructor to pass the email address and other data
    public function __construct($companyEmail, $companyName, $allEmployeeAssetDetails)
    {
        $this->companyEmail = $companyEmail;
        $this->companyName = $companyName;
        $this->allEmployeeAssetDetails = $allEmployeeAssetDetails;
    }

    // Handle the job
    public function handle()
    {
        try {
            $fileName = 'employee_asset_' . now()->format('Y_m_d_H_i_s') . '.xlsx';
            $filePath = 'asset_excel/' . $fileName;
            $excelExport = new EmployeeAssetExport($this->allEmployeeAssetDetails);
            Excel::store($excelExport, $filePath, 'public');
            Mail::to($this->companyEmail)->send(new EmployeeAssetFileSend($filePath, $this->companyName));
            \Log::info('Email sent successfully to: ' . $this->companyEmail);
            Storage::disk('public')->delete($filePath);
        } catch (Exception $e) {
            \Log::error('Error exporting and sending file: ' . $e->getMessage());
        }
    }
}
