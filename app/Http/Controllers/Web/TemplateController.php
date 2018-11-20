<?php

namespace Vanguard\Http\Controllers\Web;

use ClassesWithParents\F;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Input;
use jdavidbakr\MailTracker\Model\SentEmail;
use RealRashid\SweetAlert\Facades\Alert;
use Vanguard\Contact;
use Vanguard\SendingProfile;
use Vanguard\Template;
use Vanguard\User;

use Mail;
use Vanguard\Http\Controllers\Controller;
use Vanguard\TemplateData;
use Session;

use Auth;

use UxWeb\SweetAlert;


use jdavidbakr\MailTracker\Model\SentEmailUrlClicked;
use jdavidbakr\MailTracker\Events\EmailSentEvent;
use Event;





class TemplateController extends Controller


{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $templates = TemplateData::all()->where('user_id',Auth::id());


        return view (('emailtemplate.index'),compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('emailtemplate.create');
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

        $this->validate($request,[

            'name'=>'required',
            'subject' =>'min:2',
            'body'=>'required'
        ]);

        $templateData = new TemplateData();

        $currentuserid = Auth::user()->id;

        $id= $templateData->id;

        $templateData->user_id=$id;
        $templateData->name =$request->input('name');
//        $templateData->from_email_address = $request->input('mail_from_address');
        $templateData->subject =$request->input('subject');
//        $templateData->file_id= $request->file('file');
        $templateData->text = $request->input('body');
        $templateData->landing_url = $request->input('landing_url');

        $templateData->landing_page_html = $request->input('landing_page_html');

        $templateData->user()->associate($currentuserid);


        $templateData->save();


        Alert::success('Template Successfully added!');



//        $request->session()->flash('success', 'Template Successfully added!');
        return redirect('emailtemplate');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
//dd($id);

        $template=TemplateData::all()->find($id);
//
//
//
        return view('emailtemplate.show',compact('template'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $template=TemplateData::all()->find($id);


        return view (('emailtemplate.edit'),compact('template'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $template = TemplateData::all()->find($request->template_id);


        $template->user_id = auth()->id();
        $template->name = $request->name;
//        $template->from_email_address = $request->mail_from_address;
        $template->subject = $request->subject;
//        $template->file_id = $request->file;
        $template->text = $request->text_body;
        $template->update();
        $templates = TemplateData::all();
        return redirect('emailtemplate');





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return string
     * @throws \Exception
     */
    public function destroy(Request $request,$template)

    {

        try{
            TemplateData::destroy($template);

            Alert::success('Template Successfully DELETED!');

//            $request->session()->flash('deleted', 'Template Successfully DELETED!');
            return redirect('sendingprofile');
        } catch (\Exception $e){
            Alert::error(' This Template is in use in one of your launched Campaigns!',' Please first delete Campaign');

//            $request->session()->flash('error', ' This Template is in use in one of your launched Campaigns! Please first delete Campaign');
            return redirect('emailtemplate');

        }






    }


    public function emailPage(Request $request){

        $email=array(

//            Input::get('templates'),
//            Input::get('sending_profiles'),
//            'templates'=>$request->templates,
            'sending_profiles'=>$request->sending_profiles,


        );

        dd($email);


//        return view('sendemail.index');
    }

    public function sendEmail(Request $request){




        $this->validate($request,[

            'templates'=>'required',
//            'subject' =>'min:2',
            'sending_profiles'=>'required'
        ]);

        $data = array(



            'templates'=>$request->templates,
//            'sending_name'=>$request->sending_name,
//            'sending_profiles'=>$request->sending_profiles,
            'subject'=>$request->subject

//            'recipients'=>$request->groups



        );

//dd($data);
//        $contacts = Contact::whereIn('user_id',[Auth::user()->id])->get();

        $contacts = Contact::whereIn('user_id',[Auth::user()->id])->whereIn('group_id',[$request->groups])->get();
        $profiles = SendingProfile::whereIn('user_id',[Auth::user()->id])->whereIn('id',[$request->sending_profiles])->get();





    foreach ($profiles as $profile){

        foreach($contacts as $contact){


            Mail::send('sendemail.sent', $data, function ($message) use ($data,$contact,$profile) {

                $message->from($profile->sending_email, $profile->sending_name);

                $message->to($contact->email);

                $message->subject($data['subject']);






            }, true);






        }}


//        Contact::where('user_id',Auth::user()->id)->delete();
        dd('sve poslato');


        //           // Provera ukoliko je mail poslat salje poruku da je uspesno i nakon toga cisti bazu kontakata u suprotnom izbacuje gresku
        if (Mail::failures()){

            Alert::error('Error');
//            print 'Fail';
        }else{
            Alert::success('Your message was sent ');

//            Session::flash('emailsuccess','Your message was sent ');

            return redirect('selectlist');
        }

    }}
