<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Program;
use App\University;
use App\Modality;
use App\System;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Program::all();
        return view('root.university.program.index',['all'=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all = University::all();
        $all2 = System::all();
        $all3 = Modality::all();
        return view('root.university.program.create',['all'=>$all,'all2'=>$all2,'all3'=>$all3]);
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
            'area'=> 'required|max:45|string',
            'enfoque'=> 'required|max:45|string',
            'tipo'=> 'required|max:45|string',
            'grado'=> 'required|max:45|string',
            'imagen' => 'required|max:1000',
            'universidad'=> 'required|numeric|digits_between:1,20',
            'sistema'=> 'required|numeric|digits_between:1,20',
            'modalidad'=> 'required|numeric|digits_between:1,20',
        ]);

        $file = $request->file('imagen')->store('program');


        $programnew = new Program;
        $programnew->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $programnew->area = mb_convert_case($request->area, MB_CASE_TITLE,"UTF-8");
        $programnew->approach = mb_convert_case($request->enfoque, MB_CASE_TITLE,"UTF-8");
        $programnew->type = mb_convert_case($request->tipo, MB_CASE_TITLE,"UTF-8");
        $programnew->grade = mb_convert_case($request->grado, MB_CASE_TITLE,"UTF-8");
        $programnew->image = $file;
        $programnew->university_id = $request->universidad;
        $programnew->modality_id = $request->modalidad;
        $programnew->system_id = $request->sistema;
        $programnew->save();

        return redirect()->action('Root\ProgramController@index')->with('status', 'Programa creado exitosamente');
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
        $program = decrypt($id);
        $info = Program::find($program);
        $all = University::all();
        $all2 = System::all();
        $all3 = Modality::all();

        return view('root.university.program.edit',['info'=>$info,'all'=>$all,'all2'=>$all2,'all3'=>$all3]);
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
        $program = decrypt($id);
        $request->validate([
            'nombre'=> 'required|max:60|string',
            'area'=> 'required|max:45|string',
            'enfoque'=> 'required|max:45|string',
            'tipo'=> 'required|max:45|string',
            'grado'=> 'required|max:45|string',
            'imagen' => 'nullable|max:1000',
            'universidad'=> 'required|numeric|digits_between:1,20',
            'sistema'=> 'required|numeric|digits_between:1,20',
            'modalidad'=> 'required|numeric|digits_between:1,20',
        ]);

        $programupdate = Program::find($program);
        $programupdate->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $programupdate->area = mb_convert_case($request->area, MB_CASE_TITLE,"UTF-8");
        $programupdate->approach = mb_convert_case($request->enfoque, MB_CASE_TITLE,"UTF-8");
        $programupdate->type = mb_convert_case($request->tipo, MB_CASE_TITLE,"UTF-8");
        $programupdate->grade = mb_convert_case($request->grado, MB_CASE_TITLE,"UTF-8");
        if(isset($request->imagen)) {
            $file = $request->file('imagen')->store('program');
            $programupdate->image = $file;
        }
        $programupdate->university_id = $request->universidad;
        $programupdate->modality_id = $request->modalidad;
        $programupdate->system_id = $request->sistema;
        $programupdate->save();

        return redirect()->action('Root\ProgramController@index')->with('status', 'Programa editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $program = decrypt($id);

        $programdelete = Program::find($program);
        $programdelete->delete();

        return redirect()->action('Root\ProgramController@index')->with('status', 'Programa eliminado exitosamente');
    }
}
