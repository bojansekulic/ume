<?php

namespace Vanguard\Http\Controllers\Web;

use Auth;
use Barryvdh\DomPDF\PDF;
use ClassesWithParents\D;
use Illuminate\Http\Request;
use jdavidbakr\MailTracker\Model\SentEmail;
use phpDocumentor\Reflection\Types\This;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Session\Session;
use Vanguard\Campaign;
use Vanguard\Http\Controllers\Controller;
use Vanguard\TemplateData;
//use Barryvdh\DomPDF\PDF;
//use RealRashid\SweetAlert\Facades\Alertk

class CampaignStatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Statistika za sve kampanje

        $clicks=SentEmail::where('user_id',Auth::id())->where('clicks','>',0)->get()->count();

        $opens=SentEmail::where('user_id',Auth::id())->where('opens','>',0)->get()->count();

        $submited=SentEmail::where('user_id',Auth::id())->where('submited','>',0)->get()->count();

        $all= SentEmail::where('user_id',Auth::id())->count();
        $allEmails = 0;
        $openEmails= 0;
        $linkClicked=0;
        $dataSubmited = 0;



        $joins= \DB::table('campaigns')
            ->join('sent_emails','campaigns.id','=','sent_emails.campaign_id')
            ->where('campaign_id','>',0)
            ->where('campaigns.user_id',Auth::id())
            ->groupBy('name')->get();




        return view('campaign_stats.index', compact('joins','opens','clicks','submited','all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


//       Statistika za svaku kampanju posebno

        $campaignId = SentEmail::all()->where('user_id',Auth::id())->where('id',$id)->pluck('campaign_id');
//dd($campaignId[0]);
        $allSent = SentEmail::where('user_id',Auth::id())->where('campaign_id',$campaignId)->count();

        $allClicks=SentEmail::where('user_id',Auth::id())->where('campaign_id',$campaignId)->where('clicks','>',0)->get()->count();

        $allOpens=SentEmail::where('user_id',Auth::id())->where('campaign_id',$campaignId)->where('opens','>',0)->get()->count();

        $allSubmited=SentEmail::where('user_id',Auth::id())->where('campaign_id',$campaignId)->where('submited','>',0)->get()->count();


       \Session::put('campId',$campaignId[0]);

//       $cid= \Session::get('campId');

//       dd($cid);


//       dd($allSent,
//       $clicks);

        $joins= \DB::table('campaigns')
            ->join('sent_emails','campaigns.id','=','sent_emails.campaign_id')
            ->join('sending_profiles','sending_profiles.id','=','campaigns.sending_profile_id')
            ->join('groups','groups.id','=','campaigns.group_id')
            ->where('sent_emails.id','=',$id)
//            -> where('user_id',Auth::id())
//            ->where('campaign.user_id','=',Auth::id())
            ->groupBy('name')->get();
//dd($joins);

        return view('campaign_stats.single_campaign_stats_preview',
            compact('joins','allSent','allClicks','allOpens','allSubmited','listSubmited'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {

//        dd($id);
        //


    $c = SentEmail::all()->where('id',$id)->pluck('campaign_id');
//        dd($c[0]);
//        SentEmail::destroy($id);
       SentEmail::where('campaign_id',$c)->delete();


//
//
        Alert::success('Campaign Successfully DELETED!');
//        $request->session()->flash('deleted', 'Campaign Successfully DELETED!');
        return redirect('campaign_stats');

    }



    public function allList(){

        $cId = \Session::get('campId');


        $allCounter=SentEmail::where('user_id',Auth::id())->where('campaign_id',$cId)->get()->count();
        $allList = SentEmail::where('user_id',Auth::id())->where('campaign_id',$cId)->orderBy('created_at','desc')->get();

        return view(('campaign_stats.single_campaign_all_list'),compact('allCounter','allList'));



    }

    public function submitedList(){

//        dd('Vies');

     $cId = \Session::get('campId');


//        dd($id);

        $submitedCounter=SentEmail::where('user_id',Auth::id())->where('campaign_id',$cId)->where('submited','>',0)->get()->count();



        $submits = SentEmail::where('user_id',Auth::id())->where('campaign_id',$cId)->where('submited','>',0)->orderBy('created_at','desc')->get();
//        dd($clicks);
        return view(('campaign_stats.single_campaign_submited_list'),compact('submits','submitedCounter','all'));



    }


    public function opensList(){

        $cId = \Session::get('campId');



        $openCounter=SentEmail::where('user_id',Auth::id())->where('campaign_id',$cId)->where('opens','>',0)->get()->count();
        $openList = SentEmail::where('user_id',Auth::id())->where('campaign_id',$cId)->where('opens','>',0)->orderBy('created_at','desc')->get();

        return view(('campaign_stats.single_campaign_opens_list'),compact('openCounter','openList'));



    }
    public function clickedList(){

        $cId = \Session::get('campId');

//        $id=$cId[0];

        $clickCounter=SentEmail::where('user_id',Auth::id())->where('campaign_id',$cId)->where('opens','>',0)->get()->count();
        $clicks = SentEmail::where('user_id',Auth::id())->where('campaign_id',$cId)->where('opens','>',0)->orderBy('created_at','desc')->get();

        return view(('campaign_stats.single_campaign_click_list'),compact('clickCounter','clicks'));



    }




    function convert_data_to_html()
    {

        $cId = \Session::get('campId');



        $allCounter=SentEmail::where('user_id',Auth::id())->where('campaign_id',$cId)->get()->count();
        $openCounter=SentEmail::where('user_id',Auth::id())->where('campaign_id',$cId)->where('opens','>',0)->get()->count();
        $clickCounter=SentEmail::where('user_id',Auth::id())->where('campaign_id',$cId)->where('opens','>',0)->get()->count();
        $submitedCounter=SentEmail::where('user_id',Auth::id())->where('campaign_id',$cId)->where('submited','>',0)->get()->count();

        $curent_date = date('d.m.y');

        $joins= \DB::table('campaigns')
            ->join('sent_emails','campaigns.id','=','sent_emails.campaign_id')
            ->join('sending_profiles','sending_profiles.id','=','campaigns.sending_profile_id')
            ->join('groups','groups.id','=','campaigns.group_id')
            ->where('sent_emails.id','=',$cId)
            ->groupBy('name')->get();


        $output = '




     <h3 align="center">Report</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="1%">Name</th>
    <th style="border: 1px solid; padding:12px;" width="1%">Start Date</th>
    <th style="border: 1px solid; padding:12px;" width="1%">Sent From</th>
    <th style="border: 1px solid; padding:12px;" width="1%">Subject</th>
    <th style="border: 1px solid; padding:12px;" width="1%">Contact Group</th>
    <th style="border: 1px solid; padding:12px;" width="1%">Total</th>
    <th style="border: 1px solid; padding:12px;" width="1%">Opens</th>
    <th style="border: 1px solid; padding:12px;" width="1%">Clicked</th>
    <th style="border: 1px solid; padding:12px;" width="1%">Submited</th>
    <th style="border: 1px solid; padding:12px;" width="1%">Created by</th>
   </tr>
     ';
        foreach($joins as $data)
        {
            $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$data->name.'</td>
       <td style="border: 1px solid; padding:12px;">'.$data->date.'</td>
       <td style="border: 1px solid; padding:12px;">'.$data->sending_name.' '. $data->sending_email.'</td>
       <td style="border: 1px solid; padding:12px;">'.$data->subject.'</td>
       <td style="border: 1px solid; padding:12px;">'.$data->group_name.'</td>
       <td style="border: 1px solid; padding:12px;">'.$allCounter.'</td>
       <td style="border: 1px solid; padding:12px;">'.$openCounter.'</td>
       <td style="border: 1px solid; padding:12px;">'. $clickCounter.'</td>
       <td style="border: 1px solid; padding:12px;">'.$submitedCounter.'</td>
       <td style="border: 1px solid; padding:12px;">'.Auth::user()->first_name.'</td>
      </tr>
      
      <h4>report downloaded on date: ' .$curent_date.'</h4>
      ';



        }

        $output .= '</table>';


        return $output;

    }

    public function report()
    {


//        return view('pdf_report.index');


        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_data_to_html());
        return $pdf->stream();


        }



}
