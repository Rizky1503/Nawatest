<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    private $cart;
    public function __construct($cart){
        $this->cart = $cart;
    }

    public function build(){
        return $this->subject('Thanks Order MotoShop '.$this->cart->user->name.'')
            ->view('Mail.order', [
            'cart' => $this->cart,
        ]);
    }
}
