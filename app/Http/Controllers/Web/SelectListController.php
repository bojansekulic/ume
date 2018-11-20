<?php

namespace Vanguard\Http\Controllers\Web;

use Auth;

use DB;


use Form;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;


use Vanguard\Contact;
use Vanguard\Groups;
use Vanguard\Http\Controllers\Controller;

use Vanguard\SendingProfile;
use Vanguard\Template;
use Vanguard\TemplateData;
use Vanguard\User;
use View;
use Vanguard\Http\Controllers\Web\TemplateController;


class SelectListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $templates = TemplateData::all()->where('user_id',Auth::id())->pluck('name','text')->prepend('SELECT TEMPLATE', '')->toArray();
//        $subject = TemplateData::all()->where('user_id',Auth::id())->pluck('name','id');
        $profiles = SendingProfile::all()->where('user_id',Auth::id())->pluck('sending_name','id')->prepend('SELECT SENDING PROFILE', '')->toArray();
        $groups = Groups::all()->where('user_id',Auth::id())->pluck('group_name','id');


       return view (('selectlist.index'),compact('templates','profiles','groups'));
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
    public function show($request,$id)
    {




        //

       // $templates=TemplateData::find($id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $templates=TemplateData::pluck('name','id');

//        $profiles =SendingProfile::pluck('sending_name','id');

//        return view('selectlist.index', compact($templates));
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
//
//        $template=TemplateData::all()->find($id);
//
//        var_dump($template);
//
//        $currentuserid = Auth::user()->id;
//
//        $id= $templateData->id;
//
//        $templateData->user_id=$id;
//        $templateData->from_name =$request->input('mail_from');
//        $templateData->from_email_address = $request->input('mail_from_address');
//        $templateData->email_subject =$request->input('mail_subject');
//        $templateData->file_id= $request->file('file');
//        $templateData->text = $request->input('text_body');
//
//
//        $templateData->user()->associate($currentuserid);
//
//
//        $templateData->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
