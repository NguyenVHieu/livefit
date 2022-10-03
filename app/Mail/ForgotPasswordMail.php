<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $token)
    {
        $this->data = $data;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.forget_password_mail')->with([
            'data'=>$this->data,
            'forgot_password_token'=>$this->token
        ]);
    }
}
