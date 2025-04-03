<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionExpiry extends Mailable
{
    use Queueable, SerializesModels;

    protected $expiryDate;
    protected $userName;
    protected $email;

    public function __construct($expiryDate, $userName, $email)
    {
        $this->expiryDate = $expiryDate;
        $this->email = $email;
        $this->userName = $userName;
    }

    public function build()
    {
        $userName = $this->userName;
        $expiryDate = $this->expiryDate;
        $email = $this->email;
        return $this->view('email.subscriptionExpiryMail', compact('userName','expiryDate','email'))
            ->subject("HrJee Subscription Expiring Soon!");
    }
}
