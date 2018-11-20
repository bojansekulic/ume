<?php

namespace Vanguard\Http\Controllers\Web;

use Auth;
use Vanguard\Campaign;
use Illuminate\Http\Request;
use Vanguard\Groups;
use Vanguard\Http\Controllers\Controller;
use Vanguard\SendingProfile;
use Vanguard\TemplateData;
use RealRashid\SweetAlert\Facades\Alert;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //



        $templates = TemplateData::all()->where('user_id',Auth::id())->pluck('name','id')->prepend('SELECT TEMPLATE', '')->toArray();
        $profiles = SendingProfile::all()->where('user_id',Auth::id())->pluck('sending_name','id')->prepend('SELECT SENDING PROFILE', '')->toArray();
        $groups = Groups::all()->where('user_id',Auth::id())->pluck('group_name','id')->prepend('SELECT CONTACT GROUP', '')->toArray();;

        $campaigns = Campaign::all()->where('user_id',Auth::id());

//        dd($campaigns);

//        dd($templates);

        return view (('campaign.index'),compact('templates','profiles','groups','campaigns'));
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

        $this->validate($request,[

            'campaign_name'=>'required',
            'templates' =>'required',
            'sending_profiles'=>'required',
            'groups'=>'required'
        ]);

        //        $templateData = new TemplateData();
        $campaign = new Campaign();


        $currentuserid = Auth::user()->id;

        $id = $campaign->id;
//        dd($id);
        $campaign->user_id=$id;
        $campaign->name=$request->input('campaign_name');
        //        $templateData->subject =$request->input('subject');

        $campaign->template_id= $request->templates;

//        dd($campaign);
        $campaign->group_id= $request->groups;
        $campaign->sending_profile_id= $request->sending_profiles;

        $campaign->user()->associate($currentuserid);

//
//
        $campaign->save();


//            Alert::success('Campaign Successfully created!','Now you can Launch');
        $request->session()->flash('success', 'Campaign Successfully added!');
        return redirect('campaign_launch');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Vanguard\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //





    }

    public function campaignPreview($id){





    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Vanguard\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

//        $detail=Campaign::all()->find($id);
//        dd($detail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Vanguard\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Vanguard\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        //

        Campaign::destroy($id);

        Alert::success('Campaign Successfully DELETED!');
//        $request->session()->flash('deleted', 'Campaign Successfully DELETED!');
        return redirect('campaign_index');



    }
}
