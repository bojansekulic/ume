<?php

namespace Vanguard\Http\Controllers\Web;

use Auth;
use Illuminate\Http\Request;
use Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use Vanguard\Http\Controllers\Controller;
use Vanguard\SendingProfile;
use Vanguard\TemplateData;

class TestController extends Controller
{
    //

    public function index()
    {
        //

//dd('tada');
        $templates = TemplateData::all()->where('user_id',Auth::id())->pluck('name','text')->prepend('SELECT TEMPLATE', '')->toArray();

        $profiles = SendingProfile::all()->where('user_id',Auth::id())->pluck('sending_name','sending_email')->prepend('SELECT SENDING PROFILE', '')->toArray();


//        $profiles = SendingProfile::all()->only('sending_name')->toArray();



        return view(('sendemail.index'),compact('templates','profiles'));
    }

    public function sendEmail(Request $request){

        $this->validate($request,[



//            'templates'=>'required',
//            'subject' =>'min:2',
//            'sending_profiles'=>'required'
//            'mail_from_address'=>'required|email',
//            'mail_subject' =>'min:2',
//            'text_body'=>'min:2'
        ]);

        $data = array(


            'templates'=>$request->templates,
            'sending_profiles'=>$request->sending_profiles,
//            'sending_profiles_name'=>SendingProfile::all()->where('user_id',Auth::id())->pluck('sending_name',['sending_name']),
            'subject'=>$request->subject,


            'fromName'=> $request->mail_from,
//            'fromAdress'=>$request->mail_from_address,
            'to'=>$request->sending_to,
//            'subject' =>$request->mail_subject,

//
        );



        Mail::send(['html'=>'sendemail.sent'], $data, function($message) use ($data){
//            $message= new \Swift_Message();
            $message->from($data['sending_profiles'],$data['fromName']);
//            $message->from($data['sending_profiles']);

            $message->to($data['to']);
//            $message->to('bojan@netpp.rs');
            $message->subject($data['subject']);






            // Provera ukoliko je mail poslat salje poruku da je uspesno i nakon toga cisti bazu kontakata u suprotnom izbacuje grasku
            if (Mail::failures()){
                Alert::error('Error ', 'Trynagain Later');
                print 'Fail';
            }else{


//
//               \DB::table('contacts')->truncate();
                //$clear->truncate();

//                \DB::table('csv_datas')->truncate();
            }

        });

        Alert::success('Your message was sent');
//        Session::flash('emailsuccess','Your message was sent');

        return redirect('sendemailform');

    }

}
