<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    //
    protected $fillable = ['user_id','group_name'];

    public function user(){

        return $this->belongsTo(User::class);
    }


    public function csvData()
    {
        return $this->hasMany(CsvData::class);
    }

    public function contacts()
    {
//         return $this->hasMany(Contact::class);
        return $this->belongsToMany(Contact::class);
    }

}
