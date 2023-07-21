<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\RegisterEmailMail;

class RegisterEmailJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user,$FourDigitRandomNumber;

    public function __construct($user,$FourDigitRandomNumber){
        $this->user = $user;
        $this->FourDigitRandomNumber = $FourDigitRandomNumber;
    }

    public function handle(){
        \Mail::to(\trim($this->user->email))
        ->send(new RegisterEmailMail(
            $this->user,
            $this->FourDigitRandomNumber
        ));
    }
}
