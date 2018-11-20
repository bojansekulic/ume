<?php

namespace Vanguard\Http\Controllers\Web;

use Auth;
use Illuminate\Http\Request;
use jdavidbakr\MailTracker\Model\SentEmail;
use Vanguard\Http\Controllers\Controller;

class WhoClickedController extends Controller
{
    //

    public function index()
    {

        //


//        $clicks=SentEmail::all();
//        $clicks=SentEmail::where('user_id',Auth::user())->where('clicks','>',0)->orderBy('created_at','desc')->get();



        $allCounter=SentEmail::where('user_id',Auth::id())->where('clicks','>',0)->get()->count();
        $allList = SentEmail::where('user_id',Auth::id())->where('clicks','>',0)->orderBy('created_at','desc')->get();

        return view(('who_clicked.index'),compact('clicks','allCounter','allList'));
    }


    public function allopen(){



//        $all= SentEmail::all()->count();

        $openCounter=SentEmail::where('user_id',Auth::id())->where('opens','>',0)->get()->count();
//        dd($openCounter);
        $openList = SentEmail::where('user_id',Auth::id())->where('opens','>',0)->orderBy('created_at','desc')->get();

        return view(('who_clicked.all_open'),compact('openCounter','openList'));

    }

    public function allsubmited(){

//        $all= SentEmail::all()->count();

        $submitedCounter=SentEmail::where('user_id',Auth::id())->where('submited','>',0)->get()->count();

        $clicks = SentEmail::where('user_id',Auth::id())->where('submited','>',0)->orderBy('created_at','desc')->get();

        return view(('submit_catch.result_list'),compact('clicks','submitedCounter','all'));

    }


    public function allsent()
    {

        $all= SentEmail::where('user_id',Auth::id())->get()->count();

        $emails= SentEmail::where('user_id',Auth::id())->get();


//dd($emails);
        return view(('who_clicked.all_sent'),compact('emails','all'));
    }
}
