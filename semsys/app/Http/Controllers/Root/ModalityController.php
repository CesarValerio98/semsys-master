<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modality;

class ModalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Modality::all();
        return view('root.university.modality.index',['all'=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('root.university.modality.create');
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
            'nombre'=> 'required|max:45|string',
        ]);
        $modalitynew= new Modality;
        $modalitynew->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $modalitynew->save();
        return redirect()->action('Root\ModalityController@index')->with('status', 'Modalidad creada exitosamente');
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
        $modality = decrypt($id);
        $all = Modality::find($modality);
        return view('root.university.modality.edit', ['info'=>$all]);
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
        $modality = decrypt($id);
        $request->validate([
            'nombre'=> 'required|max:45|string',
        ]);
        $modalityup= Modality::find($modality);
        $modalityup->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $modalityup->save();
        return redirect()->action('Root\ModalityController@index')->with('status', 'Modalidad editada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modality = decrypt($id);

        $modalitydelete = Modality::find($modality);
        $modalitydelete->delete();

        return redirect()->action('Root\ModalityController@index')->with('status','Modalidad eliminada exitosamente');
    }
}
