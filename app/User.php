<?php

namespace App;

use App\Notifications\VerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verify_token', 'confirmed', 'admin', 'username', 'phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return bool
     */

    public function verified(){
        return $this->confirmed && ($this->verify_token === null);
    }

    /**
     * This tells if the current user object is an admin or not.
     * 
     * @return bool
     */

    public function isAdmin(){
        return $this->admin;
    }

    //relationships

    public function groups()
    {
        return $this->hasMany('App\Group');
    }//end of groups()

    public function sms()
    {
        return $this->hasMany('App\Sms');
    }
    //end of relationships

    //helper methods

    /**
     * This is gonna send the user a verification email
     * 
     * @return void
     */

    public function sendVerificationEmail(){
        $this->notify(new VerifyEmail($this));
    }

    public function totalSMSSent()
    {
        $total_messages = 0;
        $smses = $this->sms;
        foreach($smses as $sms){
            $total_messages += $sms->messages->count();
        }
        return $total_messages;
        //return $this->sms->messages->count();
    }
}
