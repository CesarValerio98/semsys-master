<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\System;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = System::all();
        return view('root.university.system.index',['all'=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('root.university.system.create');
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
        $systemnew= new System;
        $systemnew->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $systemnew->save();
        return redirect()->action('Root\SystemController@index')->with('status', 'Sistema creado exitosamente');
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
        $system = decrypt($id);
        $all = System::find($system);
        return view('root.university.system.edit', ['info'=>$all]);
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
        $system = decrypt($id);
        $request->validate([
            'nombre'=> 'required|max:45|string',
        ]);
        $systemup= System::find($system);
        $systemup->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $systemup->save();
        return redirect()->action('Root\SystemController@index')->with('status', 'Sistema editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $system = decrypt($id);

        $systemdelete = System::find($system);
        $systemdelete->delete();

        return redirect()->action('Root\SystemController@index')->with('status','Sistema eliminado exitosamente');
    }
}
