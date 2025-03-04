<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployeePayslipFile extends Mailable
{
    use Queueable, SerializesModels;

    protected $pdf;
    protected $employeeName;

    public function __construct($pdf, $employeeName)
    {
        $this->pdf = $pdf;
        $this->employeeName = $employeeName;
    }

    public function build()
    {
        $userName = $this->employeeName;
        return $this->view('email.employeePayslip', compact('userName'))
            ->attachData($this->pdf->output(), $userName . Carbon::now()->subMonth()->format('-M-Y') . 'pdf', [
                'mime' => 'application/pdf',
            ])
            ->subject("Employee Payslip Mail");
    }
}
