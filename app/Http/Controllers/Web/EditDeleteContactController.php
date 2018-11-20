<?php

namespace Vanguard\Http\Controllers\Web;

use Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Vanguard\Contact;
use Vanguard\Http\Controllers\Controller;

class EditDeleteContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $detail=Contact::all()->find($id);


        return view (('groups_contacts.edit_single_contact'),compact('detail'));
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

//dd($id);
//
        $detail = Contact::all()->find($request->id);
//        dd($detail);

        $detail->user_id = auth()->id();
        $detail->first_name = $request->first_name;
        $detail->last_name = $request->last_name;
        $detail->email = $request->email;

        $detail->update();

        Alert::success( 'Contact Successfully updated!');
//        $request->session()->flash('updated', 'Contact Successfully updated!');
        return redirect('groups_m');
//        return ('Izmenjeno');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($detail,Request $request)
    {
        //

        Contact::destroy($detail);


        Alert::success('Contact Successfully deleted from the group!');
//        $request->session()->flash('deleted', 'Contact Successfully deleted from the group!');
        return redirect('groups_m');
    }
}
