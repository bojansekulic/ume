<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;

class SubmitCatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(isset($request->hash)){
            $hash = $request->hash;
        }else{
            $hash = '';
        }

        return view('submit_catch.index')->with(['hash' => $hash]);
    }


}
