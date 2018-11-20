<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //

    public $fillable = ['first_name', 'last_name', 'email','group_id'];



    public function user(){

        return $this->belongsTo(User::class);
    }

    public function group(){
//        $this->belongsTo(Groups::class,'group_id');
        $this->belongsToMany(Groups::class);
    }
}
