<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['gname', 'user_id'];

    //relationships
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
}
