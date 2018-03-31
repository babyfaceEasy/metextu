<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['cname', 'cphone_no', 'group_id'];

    //relationships
    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
