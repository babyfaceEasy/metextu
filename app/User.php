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
        'name', 'email', 'password', 'verify_token', 'confirmed', 'admin'
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

    /**
     * This is gonna send the user a verification email
     * 
     * @return void
     */

    public function sendVerificationEmail(){
        $this->notify(new VerifyEmail($this));
    }
}
