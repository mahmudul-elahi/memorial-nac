<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TwoFactorCode extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    // Constructor to pass the OTP to the mailable
    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    // Build the message (email content)
    public function build()
    {
        return $this->subject('Your 2FA OTP Code')
            ->view('emails.two_factor_code') // Email view to display OTP
            ->with(['otp' => $this->otp]);
    }
}
