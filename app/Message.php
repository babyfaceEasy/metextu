<?php

namespace App;

use App\Sms;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable  = [
        'sms_id',
        'messageUUID',
        'to',
        'status',
        'units',
        'totalRate',
        'totalAmount',
        'MCC',
        'MNC',
        'errorCode',
        'parentMessageUUID',
        'parentInfo',
    ];

    //relationships
    public function sms()
    {
        return $this->belongsTo(Sms::class);
    }
}
