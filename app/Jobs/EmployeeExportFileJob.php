<?php

namespace App\Jobs;

use App\Mail\EmployeeFileSend;
use App\Exports\EmployeeExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

class EmployeeExportFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $companyName;
    protected $companyEmail;
    protected $allEmployeeDetails;

    // Constructor to pass the email address
    public function __construct($companyEmail, $companyName, $allEmployeeDetails)
    {
        $this->companyEmail = $companyEmail;
        $this->companyName = $companyName;
        $this->allEmployeeDetails = $allEmployeeDetails;
    }

    // Handle the job
    public function handle()
    {
        try {
            $fileName = 'employee_details_' . now()->format('Y_m_d_H_i_s') . '.xlsx';
            $filePath = 'employee_excel_sheet/' . $fileName;
            $excelExport = new EmployeeExport($this->allEmployeeDetails);
            $stored = Excel::store($excelExport, $filePath, 'public');
            if ($stored) {
                Mail::to($this->companyEmail)->send(new EmployeeFileSend($filePath, $this->companyName));
                \Log::info('Email sent successfully to: ' . $this->companyEmail);
                Storage::disk('public')->delete($filePath);
            } else {
                \Log::error('Failed to store the Excel file.');
            }
        } catch (\Exception $e) {
            \Log::error('Error exporting and sending file: ' . $e->getMessage());
        }

    }
}
