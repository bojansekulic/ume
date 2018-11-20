<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use jdavidbakr\MailTracker\Model\SentEmail;

class PhishingSubmited extends Model
{
    //


    protected $table = 'phishing_submiteds';

    protected $fillable = [
        'sent_email_id',
        'hash',
        'is_submited',
    ];


    public function hash()
    {
        return $this->belongsTo(SentEmail::class,'sent_email_id');
    }
}
