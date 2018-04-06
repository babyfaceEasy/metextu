<?php

namespace App;

use App\User;
use App\Message;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $fillable = ['message', 'user_id', 'api_id', 'sender_name'];

    //relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    //helper methods
    /*
    public function totalSMSSent()
    {
        return $this->messages->count();
    }
    */
}
