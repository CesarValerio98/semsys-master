<?php

namespace App\Http\Controllers\Root;
use App\User;
use App\Role;
use App\University;
use App\AddressUniversity;
use App\State;
use App\Municipality;
use App\Locality;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AddressUniController extends Controller
{

    public function viewmunicipalities(Request $request)
    {
        if ($request->ajax()) {
        $municipality = Municipality::where('state_id',$request->state)->get();
        $output= '<option value="">Elija una opción</option>';
        foreach ($municipality as $key) {
          $output.='<option value="'.$key->id.'">'.$key->name.'</option>';
        }
        return response()->json($output);
      }
    }

    public function viewlocations(Request $request)
    {
        if ($request->ajax()) {
        $locality = Locality::where('municipality_id',$request->municipio)->get();
        $output= '<option value="">Elija una opción</option>';
        foreach ($locality as $key) {
          $output.='<option value="'.$key->id.'">'.$key->name.'</option>';
        }
        return response()->json($output);
      }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = AddressUniversity::all();
        return view('root.university.addressuni.index',['all'=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $university = decrypt($id);
        $all = University::find($university);
        $state = State::all();
        return view('root.university.addressuni.create', ['all'=>$all, 'state'=>$state]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'calle' => 'required|max:100|string',
        'codigo_postal' => 'required|max:20|string',
        'numero' => 'required|numeric|digits_between:1,20',
        'campus' => 'required|max:50|string',
        'referencia' => 'required|max:255|string',
        'localidad' => 'required|numeric|digits_between:1,20',
        ]);

        $addressuninew = new AddressUniversity();
        $addressuninew->street = mb_convert_case($request->calle, MB_CASE_TITLE,"UTF-8");
        $addressuninew->zip_code = $request->codigo_postal;
        $addressuninew->number = $request->numero;
        $addressuninew->campus =  mb_convert_case($request->campus, MB_CASE_TITLE,"UTF-8");
        $addressuninew->description = $request->referencia;
        $addressuninew->locality_id = $request->localidad;
        $addressuninew->university_id = decrypt($request->university);
        $addressuninew->save();

        return redirect()->action('Root\AddressUniController@show', [$request->university])->with('status','Dirección agregada exitosamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $university = decrypt($id);
        $exists = AddressUniversity::where('university_id',$university)->exists();
        $all = University::find($university);
        if ($exists >= '1') {
            $addresses = AddressUniversity::where('university_id',$university)->get();
            return view('root.university.addressuni.show', ['all'=>$all,'addresses'=>$addresses]);
        }else{
            $state = State::all();
            return view('root.university.addressuni.create', ['all'=>$all, 'state'=>$state]);
        }   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $university = decrypt($id);
        $all = AddressUniversity::find($university);
        $state = State::all();

        return view('root.university.addressuni.edit', ['all'=>$all, 'state'=>$state]);
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
        $addressuni = decrypt($id);
        $request->validate([
        'calle' => 'required|max:100|string',
        'codigo_postal' => 'required|max:20|string',
        'numero' => 'required|numeric|digits_between:1,20',
        'campus' => 'required|max:50|string',
        'referencia' => 'required|max:255|string',
        'localidad' => 'required|numeric|digits_between:1,20',
        ]);

        $addressuniupdate = AddressUniversity::find($addressuni);
        $addressuniupdate->street = mb_convert_case($request->calle, MB_CASE_TITLE,"UTF-8");
        $addressuniupdate->zip_code = $request->codigo_postal;
        $addressuniupdate->number = $request->numero;
        $addressuniupdate->campus =  mb_convert_case($request->campus, MB_CASE_TITLE,"UTF-8");
        $addressuniupdate->description = $request->referencia;
        $addressuniupdate->locality_id = $request->localidad;
        $addressuniupdate->save();

        return redirect()->action('Root\AddressUniController@show', [encrypt($addressuniupdate->university_id)])->with('status','Dirección editada exitosamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $addressuni = decrypt($id);

        $addressunidelete = AddressUniversity::find($addressuni);
        $addressunidelete->delete();

        return redirect()->action('Root\AddressUniController@show', [encrypt($addressunidelete->university_id)])->with('status','Direccion eliminada exitosamente');
    }
}
