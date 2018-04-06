<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextMessage extends Model
{
    //
    protected $fillable = ['user_id', 'message', 'api_id', 'message_ids', 'dst_nos'];
}
