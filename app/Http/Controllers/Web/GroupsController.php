<?php

namespace Vanguard\Http\Controllers\Web;

use Auth;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;
use Vanguard\Contact;
use Vanguard\Groups;
use Vanguard\Http\Controllers\Controller;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //



        $groups = Groups::all()->where('user_id',Auth::id());
//        $lists = Groups::all()->where('user_id',Auth::id())->pluck('group_name','id');
        $lists = Groups::all()->where('user_id',Auth::id());
        return view(('groups_contacts.gm' ),compact('groups','lists')) ;
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


        $details = Contact::all()->where('user_id',Auth::id())->where('group_id',$id);


        return view(('groups_contacts.group_preview' ),compact('details')) ;



    }
    public function gm(){


        $groups = Groups::all();


        return view(('groups_contacts.gm' ),compact('groups')) ;

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
//dd($id);
        $group=Groups::all()->find($id);


        //dd($template);
        return view (('groups_contacts.edit_g_name'),compact('group'));
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
//dd($request);
        $group = Groups::all()->find($request->group_id);


        $group->user_id = auth()->id();
        $group->group_name = $request->group_name;

        $group->update();

        Alert::success('Group Name Successfully Updated!');

//        $request->session()->flash('updated', 'Group Name Successfully Updated!');
        return redirect('groups_m');


    }






public function add_single_contact(){


    $lists = Groups::all()->where('user_id',Auth::id())->pluck('group_name','id');

    return view('groups_contacts.add_single_contact',compact('lists'));

}


public function process_single_contact(Request $request){

//dd($request->email);

//
//    $this->validate($request,[
//
//        'group_id'=>'required',
//        'f_name'=>'required',
//        'l_name' =>'required',
//        'email'=>'required|email'
//    ]);


    // PROVERA BAZE DA NE DODJE DO DUPLIH UNOSA // TREBA ODRADITI AUTH

//    $check = Contact::all()->where('user_id',Auth::id())->where('email', '=', $request->email)->first();
//    if ($check !== null) {
//        // email adresa nije null, postoji u bazi
//
//        return  'Korisnik sa ovom email adresom: ' .$request->email . ' ' . ' Postoji' ;
////                break;
//    }else {


//    $group_id=\Input::get('group_id');
    $group_id = $request->group_list;
//    dd($group_id);

// BRISANJE DUPLIH KONTAKATA

    $contact_data = Contact::all()->where('user_id',Auth::id())->where('group_id','=',$group_id)->where('email', '=', $request->email);


    if ($contact_data->count() > 0){


        $top = $contact_data->first();

        Contact::where('group_id','=',$top->group_id)->where('email', '=', $request->email)->delete();



    }

        $contact = new Contact();

//        $name = \Input::get('f_name');

        $name = $request->f_name;
        $last_name = $request->l_name;



//        $last_name = \Input::get('l_name');

//        $email = \Input::get('email');

        $email = $request->email;

        $contact->first_name = $name;
        $contact->last_name = $last_name;
        $contact->email = $email;

        // Dodeljivanje grupe (group_id) kontaktima

//        $group_id = \Input::get('group_id');


        $curentGroup = Groups::all();

        $contact->group_id = $group_id;
        $contact->user()->associate($curentGroup);

        // Dodeljivanje user_id-a koji je kreirao kontakt

        $currentuserid = Auth::user()->id;

        $id = $contact->id;

        $contact->user_id = $id;
        $contact->user()->associate($currentuserid);


        $contact->save();

    Alert::success('Contact Successfully Imported !');
//        $request->session()->flash('success', 'Contact Successfully Imported !');
        return redirect('groups_m');

    }
//    return redirect('groups_m');




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$group)
    {
        //

//        dd($group);
//        Contact::all()->where('user_id',Auth::id())->where('group_id',$group)->delete();
//        Contact::all()->where('group_id',$group)->delete();

//        work
//        Contact::where('user_id',Auth::user()->id)->where('group_id',$group)->delete();
//        Groups::destroy($group);

//       $cnt= Contact::all()->where('group_id',$group);
//
//       Contact::destroy($cnt);

        try{
            Contact::where('user_id',Auth::user()->id)->where('group_id',$group)->delete();
            Groups::destroy($group);

            Alert::success('Group Successfully DELETED!');

//            $request->session()->flash('deleted', 'Group Successfully DELETED!');
            return redirect('groups_m');
        } catch (\Exception $e){

            Alert::error(' This Group is in use in one of your launched Campaigns! Please first delete Campaign');
//            $request->session()->flash('error', ' This Group is in use in one of your launched Campaigns! Please first delete Campaign');
            return redirect('groups_m');

        }
//        $request->session()->flash('deleted', 'Group Successfully DELETED!');
//        return redirect('groups_m');
    }
}
