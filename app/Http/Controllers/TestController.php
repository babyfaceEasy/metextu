<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Notifications\VerifyEmail;
use Illuminate\Notifications\Notifiable;

class TestController extends Controller
{
    use Notifiable;

    public $email = 'oodegbaro@gmail.com';
    
    public function sendMail()
    {
        $user = User::findOrFail(2);
        /*Mail::send('emails.testMail', [], function($message){
            $message->to('oodegbaro@gmail.com');
            $message->subject('Sendgrid Testing');
        });*/

        $this->notify(new VerifyEmail($user));

        dd('Mail send was successful');
    }

}
