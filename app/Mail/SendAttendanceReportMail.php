<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendAttendanceReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fileName;
    public $fromDate;
    public $toDate;

    public function __construct($fileName, $fromDate, $toDate)
    {
        $this->fileName = $fileName;
        $this->$fromDate = $fromDate;
        $this->$toDate = $toDate;

        Log::info('Building attendance report mailcxvzxcvcxv', [
            'fileName' => $this->fileName,
            'from' => $this->fromDate,
            'to' => $this->toDate,
        ]);
    }

    public function build()
    {
        Log::info('Building attendance report mail', [
            'fileName' => $this->fileName,
            'from' => $this->fromDate,
            'to' => $this->toDate,
        ]);
        return $this->subject('Your Attendance Report')
            ->view('email.attendance-report')  // This is the blade view file for body
            ->attach(storage_path('app/' . $this->fileName));
    }
}


?>