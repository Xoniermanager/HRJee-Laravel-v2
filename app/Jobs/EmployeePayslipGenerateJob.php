<?php

namespace App\Jobs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use App\Mail\EmployeePayslipFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Services\GenerateSalaryService;
use App\Models\UserMonthlySalary;

class EmployeePayslipGenerateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $employeeDetails;
    public function __construct($employeeDetails)
    {
        $this->employeeDetails = $employeeDetails;
    }
    public function handle(GenerateSalaryService $generateSalaryService)
    {
        try {
            $allEmployeeDetails = $this->employeeDetails;
            foreach ($allEmployeeDetails as $item) {
                $request =
                    [
                        'user_id' => $item->id,
                        'year' => Carbon::now()->subMonth()->format('Y'),
                        'month' => Carbon::now()->subMonth()->format('n'),
                    ];
                $pdfData = $generateSalaryService->generateSalaryByEmployeeDetails($request);
                if ($pdfData['status']) {
                    if ($pdfData['mail'] == '0') {
                        $pdf = PDF::loadView('salary_temp', ['data' => $pdfData]);
                        Mail::to("arjun@xoniertechnologies.com")->send(new EmployeePayslipFile($pdf, $item->name));
                        UserMonthlySalary::where('user_id', $item->id)->where('year', $request['year'])->where('month', $request['month'])->update(['mail_send' => 1]);
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Error sending file: ' . $e->getMessage());
        }
    }
}
