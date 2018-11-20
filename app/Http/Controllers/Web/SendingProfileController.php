<?php

namespace Vanguard\Http\Controllers\Web;

use function GuzzleHttp\Promise\exception_for;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Response;
use Vanguard\Http\Controllers\Controller;
use Vanguard\SendingProfile;


class SendingProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //




        $profiles = SendingProfile::all()->where('user_id',Auth::id());

//        dd($profiles);

        return view('sendingprofile.index',compact('profiles'));


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
     * @return \Illuminate\Http\JsonResponse
     */



    public function store(Request $request)
    {
        //

        $this->validate($request,[

            'sending_name'=>'required',
            'sending_email'=>'required'

        ]);

        $profile = new SendingProfile();
        $currentuserid = Auth::user()->id;

        $id= $profile->id;

        $profile->user_id=$id;
        $profile->sending_name =$request->input('sending_name');
        $profile->sending_email =$request->input('sending_email');



        $profile->user()->associate($currentuserid);


        $profile->save();

        Alert::success( 'Profile Successfully created !');

//        $request->session()->flash('success', 'Profile Successfully created !');
        return redirect('sendingprofile');









            }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //




//        return view(('sendingprofile.index'), compact('sendingProfiles'));
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


        $profile=SendingProfile::all()->find($id);

        return view (('sendingprofile.edit'),compact('profile'));
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
        //

        $profile = SendingProfile::all()->find($request->profile_id);


        $profile->user_id = auth()->id();
        $profile->sending_name = $request->sending_name;

        $profile->sending_email = $request->sending_email;

        $profile->update();

        Alert::success('Profile Successfully UPDATED!');

//        $request->session()->flash('updated', 'Profile Successfully UPDATED!');
        return redirect('sendingprofile');

//        return redirect('sendingprofile');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$profile)
    {
        //




      try{
          SendingProfile::destroy($profile);

          Alert::success('Profile Successfully DELETED!');

//          $request->session()->flash('deleted', 'Profile Successfully DELETED!');

        return redirect('sendingprofile');
      } catch (\Exception $e){

          Alert::error(' This profile is in use in one of your launched Campaigns!',' Please first delete Campaign');
//          $request->session()->flash('error', ' This profile is in use in one of your launched Campaigns! Please first delete Campaign');
          return redirect('sendingprofile');

      }
    }
}
