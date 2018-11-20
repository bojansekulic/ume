<?php
/**
 * Created by PhpStorm.
 * User: bojan
 * Date: 15/03/2018
 * Time: 15:13
 */

namespace Vanguard;



use Illuminate\Database\Eloquent\Model;

class TemplateData extends Model
{


    protected $fillable = [

        'user_id','from_name','from_email_address','email_subject','file_id','text','landing_page_html','landing_url'

    ];

protected $table ='templates';

    public static function where($string, $id)
    {
    }


    public function user(){

        return $this->belongsTo(User::class);
    }


}