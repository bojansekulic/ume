<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class SendingProfile extends Model
{
    //

    protected $fillable= [

        'user_id','sending_name','sending_email'

    ];

    public function user()
    {

        return $this->belongsTo(User::class);
    }


}
