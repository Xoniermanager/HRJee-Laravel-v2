<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployeeAssetFileSend extends Mailable
{
    use Queueable, SerializesModels;

    protected $fileName;
    protected $companyName;

    public function __construct($fileName, $companyName)
    {
        $this->fileName = $fileName;
        $this->companyName = $companyName;
    }

    public function build()
    {
        return $this->subject('Employee Asset Details Export')
            ->view('email.employeeAssetSend')
            ->with([
                'companyName' => $this->companyName, // Passing companyName to the view
            ]) // This is the view we will create next
            ->attach(storage_path('app/public/' . $this->fileName), [
                'as' => $this->fileName,
                'mime' => 'application/vnd.ms-excel',
            ]);
    }
}
