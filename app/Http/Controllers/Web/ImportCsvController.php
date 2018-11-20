<?php

namespace Vanguard\Http\Controllers\Web;

use Auth;
use DB;
use File;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;
use Session;

use Vanguard\Groups;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Contact;
use Vanguard\CsvData;
use Maatwebsite\Excel\Facades\Excel;
use Vanguard\Http\Requests\CsvImportRequest;
use Dsaio\CsvValidator\Facades\CsvValidator;




class ImportCsvController extends Controller
{
    //

    public function index()
    {


//        $lists = Groups::all()->pluck('group_name');



        return view(('csv.import' ));
    }

    public function getImport()
    {

        return view('csv.import');

    }


    public function parseImport(CsvImportRequest $request)
    {
        $lists = Groups::all()->where('user_id',Auth::id())->pluck('group_name','id');


// Validate input file
//
//        $this->validate($request,[
//
//            'csv_file'=>'required|mimes:csv'
//        ]);


        $path = $request->file('csv_file')->getRealPath();


//        dd($path);


        if ($request->hasFile('csv_file')) {

            //==========VALIDACIJA CSVa pri inputu fajla ==================
            $extension = File::extension($request->csv_file->getClientOriginalName());

            // dd($extension);
            if ($extension != "csv") {

                Alert::warning('Please upload a valid CSV File');

//                Session::flash('csvfail', 'Please upload a valid CSV File');
                return redirect('csv');
            } else {


//                VALIDACIJA STRUKTURE CSV-a

                $file = new \SplFileObject($path);


                $rules = ['First name' => 'required',
                    'Last name' => 'required',
                    'Email' => 'required|email'
                ];

                $csv_validator = CsvValidator::make($file, $rules);


                if ($csv_validator->fails()) {

                    $err = $csv_validator->getErrors();

//                                        dd($err);


                    $errors = serialize($err);
                    $jsonErrors = json_encode($errors);


//                    dd($errors);

//                    return \Redirect::back()->withErrors($errors);
//
                    return view('csv.validate', compact('jsonErrors'));

                }


                if ($request->has('header')) {

                    $data = Excel::load($path, function ($reader) {
                    })->get()->toArray();

                } else {

                    $data = array_map('str_getcsv', file($path));

                }

                if (count($data) > 0) {

                    if ($request->has('header')) {

                        $csv_header_fileds = [];

                        foreach ($data[0] as $key => $value) {

                            $csv_header_fileds[] = $key;
                        }

                    }


                }

                $csv_data = array_slice($data, 0, 2);


                $csv_data_file = new CsvData();


                $currentuserid = Auth::user()->id;

                $id = $csv_data_file->id;

                $csv_data_file->user_id = $id;
                $csv_data_file->csv_filename = $request->file('csv_file')->getClientOriginalName();
                $csv_data_file->csv_header = $request->has('header');
                $csv_data_file->csv_data = json_encode($data);


                $csv_data_file->user()->associate($currentuserid);
                $csv_data_file->save();

            }
        } else {

            return redirect()->back();
        }

        return view('csv.import_fields', compact('csv_header_fields', 'csv_data', 'csv_data_file','lists'));
    }


    public function processImport(Request $request)
    {



        $data = CsvData::find($request->csv_data_file_id);


        // $csv_data=Auth::user();
        $csv_data = json_decode($data->csv_data, true);



        foreach ($csv_data as $row) {


            $group_id=\Input::get('group_id');

// BRISANJE DUPLIH KONTAKATA

            $contact_data = Contact::all()->where('user_id',Auth::id())->where('group_id','=',$group_id)->where('email', '=', $row['email']);


            if ($contact_data->count() > 0){


                $top = $contact_data->first();

                Contact::where('group_id','=',$top->group_id)->where('email', '=', $row['email'])->delete();



            }


// PROVERA BAZE DA NE DODJE DO DUPLIH UNOSA // TREBA ODRADITI AUTH




//            $check = Contact::all()->where('user_id',Auth::id())->where('email', '=', $row['email'])->first();
//
//            if ($check !== null) {
//                // email adresa nije null, postoji u bazi
//
//                return  'Korisnik sa ovom email adresom: ' .$row['email']. ' ' . ' Postoji' ;
////                break;
//            }else
//            {


            $contact = new Contact();
            foreach (config('app.db_fields') as $index => $field) {
                if ($data->csv_header) {


                    $contact->$field = $row[$request->fields[$field]];



                } else {
                    $contact->$field = $row[$request->fields[$index]];

                }





            }


//            }




            // Dodeljivanje grupe (group_id) kontaktima


//            $group_id=\Input::get('group_id');
//
            $curentGroup = Groups::all();

            $contact->group_id=$group_id;
            $contact->user()->associate($curentGroup);

            // Dodeljivanje user_id-a koji je kreirao kontakt

            $currentuserid = Auth::user()->id;

            $id = $contact->id;

            $contact->user_id = $id;



            $contact->user()->associate($currentuserid);




            $contact->save();




            // KREIRANJE PIVOT TABELE CONTACT_GROUPS
//
//            $kontakti= Contact::all();
//
//            $pivot = Groups::find($group_id);
//            $pivot->contacts()->sync($kontakti);

        }

        Alert::success('CSV Contacts Successfully Imported !');
//        $request->session()->flash('success', 'CSV Contacts Successfully Imported !');
        return redirect('groups_m');

//        return view('csv.import_success');
    }


    public function show()
    {


//        $contacts = Contact::all()->where('user_id', Auth::id());


        $contacts = DB::table('groups')
            ->join('contacts','groups.id','=','contacts.group_id')
            ->where('contacts.user_id','=',Auth::id())
            ->get();



        return view(('contact_list.index'), compact('contacts'));
    }


    public function validateFileStructure()
    {


        return view('csv.validate');


    }





// >>>>>> STORING A GROUP <<<<<<<<<<
    /**
     * @param Request $request
     */
    public function store(Request $request){

        $this->validate($request,[

            'group_name'=>'required',

        ]);

        $group = new Groups();
        $currentuserid = Auth::user()->id;

        $id= $group->id;

        $group->user_id=$id;
        $group->group_name =$request->input('group_name');



        $group->user()->associate($currentuserid);


        $group->save();

        Alert::success('Group created!');

//        $request->session()->flash('success', 'Group created!');
        return redirect('groups_m');


}


    public function showList(){
//        $profiles = SendingProfile::all()->where('user_id',Auth::id())->pluck('sending_name','sending_email')->prepend('SELECT SENDING PROFILE', '')->toArray();
        $lists = Groups::all()->where('user_id',Auth::id())->pluck('group_name','id');

        return view(('csv.import'), compact('lists'));

}
}
