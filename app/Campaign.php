<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use jdavidbakr\MailTracker\Model\SentEmail;

class Campaign extends Model
{
    //

    public $fillable = ['name', 'template_id','group_id','sending_profile_id'];



    public function user(){

        return $this->belongsTo(User::class);
    }

    public function groups(){

        $this->belongsTo(Groups::class);
    }


    public function template(){

        return $this->belongsTo(TemplateData::class);
    }

    public function sending_profile(){

        $this->belongsTo(SendingProfile::class);
    }


    public function sent_emails(){

        return $this->belongsToMany(SentEmail::class);
    }
}
