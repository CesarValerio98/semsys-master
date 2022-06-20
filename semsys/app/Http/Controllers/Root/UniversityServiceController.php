<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UniversityService;
use App\University;

class UniversityServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = UniversityService::all();
        return view('root.university.serviceuni.index',['all'=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all = University::all();
        return view('root.university.serviceuni.create',['all'=>$all]);
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
            'nombre'=> 'required|max:60|string',
            'tipo'=> 'required|max:45|string',
            'descripcion'=> 'required|max:255|string',
            'universidad'=> 'required|numeric|digits_between:1,20',
        ]);

        $serviceuniversitynew= new UniversityService;
        $serviceuniversitynew->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $serviceuniversitynew->description = $request->descripcion;
        $serviceuniversitynew->type = mb_convert_case($request->tipo, MB_CASE_TITLE,"UTF-8");
        $serviceuniversitynew->university_id = $request->universidad;
        $serviceuniversitynew->save();

        return redirect()->action('Root\UniversityServiceController@index')->with('status', 'Servicio creado exitosamente');
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
        $service = decrypt($id);
        $info = UniversityService::find($service);
        $all = University::all();
        return view('root.university.serviceuni.edit',['info'=>$info,'all'=>$all]);
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
        $service = decrypt($id);
        $request->validate([
            'nombre'=> 'required|max:60|string',
            'tipo'=> 'required|max:45|string',
            'descripcion'=> 'required|max:255|string',
            'universidad'=> 'required|numeric|digits_between:1,20',
        ]);

        $serviceuniversityupdate= UniversityService::find($service);
        $serviceuniversityupdate->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $serviceuniversityupdate->description = $request->descripcion;
        $serviceuniversityupdate->type = mb_convert_case($request->tipo, MB_CASE_TITLE,"UTF-8");
        $serviceuniversityupdate->university_id = $request->universidad;
        $serviceuniversityupdate->save();

        return redirect()->action('Root\UniversityServiceController@index')->with('status', 'Servicio editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = decrypt($id);

        $servicedelete = UniversityService::find($service);
        $servicedelete->delete();

        return redirect()->action('Root\UniversityServiceController@index')->with('status','Servicio eliminado exitosamente');
    }
}
