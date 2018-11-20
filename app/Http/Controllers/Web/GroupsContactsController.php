<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Contact;
use Vanguard\Groups;
use Vanguard\Http\Controllers\Controller;

class GroupsContactsController extends Controller
{
    //

    public function index()
    {
        //



        return view('groups_contacts.index');

    }


    public function gm(){


        $groups = Groups::all();


        return view(('groups_contacts.gm' ),compact('groups')) ;

    }

    public function show()
    {
        //



//        return view('groups_contacts.index');

    }

    public function edit()
    {
        //



        return view('groups_contacts.index');

    }


    public function destroy(Request $request,$group)

    {

        dd($group);
//         dd($group);
//
//        Groups::destroy($group);
//
//        $request->session()->flash('deleted', 'Group Successfully DELETED!');
//        return redirect('group_management');




    }

}
