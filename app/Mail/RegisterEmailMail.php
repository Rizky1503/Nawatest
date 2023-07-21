<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class RegisterEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user,$FourDigitRandomNumber;
    public function __construct($user,$FourDigitRandomNumber){
        $this->user = $user;
        $this->FourDigitRandomNumber = $FourDigitRandomNumber;
    }

    public function build(){
        return $this->subject('Register MotoShop '.$this->user->name.'')
            ->view('Mail.register', [
            'user' => $this->user,
            'FourDigitRandomNumber' => $this->FourDigitRandomNumber
        ]);
    }
}
