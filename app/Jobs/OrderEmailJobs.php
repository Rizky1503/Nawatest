<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\OrderEmailMail;

class OrderEmailJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $cart;

    public function __construct($cart){
        $this->cart = $cart;
    }

    public function handle(){
        \Mail::to(\trim($this->cart->user->email))
        ->send(new OrderEmailMail(
            $this->cart,
        ));
    }
}
