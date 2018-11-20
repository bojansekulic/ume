<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;


class Template extends Model
{
    //



    protected $fillable = [

        'user_id','from_name','from_email_address','email_subject','file_id','text'

    ];

    protected $table ='templates';




}
