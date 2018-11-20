<?php

namespace Vanguard\Http\Controllers\Web;

use Auth;
use Illuminate\Http\Request;
use Mail;
use Session;
use Vanguard\Campaign;
use Vanguard\Contact;
use Vanguard\Http\Controllers\Controller;
use Vanguard\SendingProfile;
use Vanguard\TemplateData;

class NewTestController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    //

    $campaign = Campaign::all()->where('user_id',Auth::id())->pluck('name','id')->prepend('SELECT Campaign', '')->toArray();

    return view (('new_test.index'),compact('campaign'));

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
    //
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
    public function destroy($id)
{
    //
}



    public function launch (Request $request){


        $this->validate($request,[


            'campaign'=>'required',
            'to'=>'required',

        ]);

    $campaign = $request->campaign;


    $campaignData = Campaign::find($campaign);



//    $contacts = Contact::whereIn('user_id',[Auth::user()->id])->whereIn('group_id',[$campaignData->group_id])->get();
    $profiles = SendingProfile::whereIn('user_id',[Auth::user()->id])->whereIn('id',[$campaignData->sending_profile_id])->get();

    $template = TemplateData::find($campaignData->template_id);



    $data= array(


        'templates'=> $template ->text,
        'subject' =>  $template -> subject,
        'to' => $request->to
    );

//dd($data);


    foreach ($profiles as $profile){

//        foreach($contacts as $contact){


            Mail::send('sendemail.sent', $data, function ($message) use ($data,$profile) {

                $message->from($profile->sending_email, $profile->sending_name);

                $message->to($data['to']);

                $message->subject($data['subject']);


            }, true);






//        }
    }


//        dd('sve poslato');


    //           // Provera ukoliko je mail poslat salje poruku da je uspesno i nakon toga cisti bazu kontakata u suprotnom izbacuje gresku
    if (Mail::failures()){

        print 'Fail';
    }else{

        Session::flash('emailsuccess','Test email is sent! ');

        return redirect('testemail');
    }

}

}

