<?php

namespace Vanguard\Http\Controllers\Web;

use Auth;
use Illuminate\Http\Request;
use jdavidbakr\MailTracker\Model\SentEmail;
use Mail;
use Session;
use Vanguard\Campaign;
use Vanguard\Contact;
use Vanguard\Http\Controllers\Controller;
use Vanguard\SendingProfile;
use Vanguard\TemplateData;
use RealRashid\SweetAlert\Facades\Alert;


class LaunchCampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $campaign = Campaign::all()->where('user_id',Auth::id())->pluck('name','id')->prepend('SELECT Campaign', '')->toArray();

        return view (('campaign.launch'),compact('campaign'));

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


        ]);



         $campaign = $request->campaign;

        Session::put('campaignId', $campaign);




$check = SentEmail::all()->where('campaign_id','=',$campaign)->first();

if ($check !== null){

//    Session::flash('duplicate','Campaign already launched ');

    Alert::info('Campaign already launched','');

    return redirect('campaign_launch');

}else
{

                $campaignData = Campaign::find($campaign);


                $contacts = Contact::whereIn('user_id', [Auth::user()->id])->whereIn('group_id', [$campaignData->group_id])->get();
                $profiles = SendingProfile::whereIn('user_id', [Auth::user()->id])->whereIn('id', [$campaignData->sending_profile_id])->get();

                $template = TemplateData::find($campaignData->template_id);


                $data = array(


                    'templates' => $template->text,
                    'subject' => $template->subject
                );




        foreach ($profiles as $profile){

            foreach($contacts as $contact){


                Mail::send('sendemail.sent', $data, function ($message) use ($data,$contact,$profile,$campaign) {

                    $message->from($profile->sending_email, $profile->sending_name);

                    $message->to($contact->email);

                    $message->subject($data['subject']);



                }, true);






            }}
            }




        //           // Provera ukoliko je mail poslat salje poruku da je uspesno i nakon toga cisti bazu kontakata u suprotnom izbacuje gresku
        if (Mail::failures()){

            Alert::error('Error', 'Try again later or conctact system administrator');
//            print 'Fail';
        }else{

              Alert::success('Campaign has launched', 'You can now track campaign stats');
//            Session::flash('emailsuccess','Campaign has launched ');

            return redirect('campaign_launch');
        }

    }



}
