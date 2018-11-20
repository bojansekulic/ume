<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class CsvData extends Model
{
    //

    protected $table = 'csv_datas';

    protected $fillable = ['csv_filename', 'csv_header', 'csv_data','user_id','gorup_id'];



    public function user(){

        return $this->belongsTo(User::class);
    }

    public function groups(){

        return $this->belongsTo(Groups::class);
    }
}
