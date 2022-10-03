<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $email_verified_code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $email_verified_code)
    {
        $this->data = $data;
        $this->email_verified_code = $email_verified_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.auth.email_verification_mail')->with([
            'data'=>$this->data,
            'email_verified_code'=>$this->email_verified_code
        ]);
    }
}
