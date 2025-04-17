<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LogActivityReport extends Mailable
{
    use Queueable, SerializesModels;
    public $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }
    public function build()
    {
        return $this->subject('Log Activity Report')
            ->attach($this->filePath)
            ->view('email.old_entries_report');
    }
}
