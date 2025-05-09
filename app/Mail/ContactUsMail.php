<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $usrSubject;
    public $message;

    public function __construct($name, $email, $usrSubject, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->usrSubject = $usrSubject;
        $this->message = $message;
    }

    public function build()
    {
        return $this->subject('Contact Request: Subscription Renewal Inquiry')
            ->view('email.contact-us')
            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'usrSubject' => $this->usrSubject,
                'usrMessage' => $this->message,
            ]);
    }
}


?>