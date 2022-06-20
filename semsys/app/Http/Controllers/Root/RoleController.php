<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use App\University;
use App\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Role::all();
        return view('root.rol.index',['all'=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all = Role::all();
        return view('root.rol.create',['all'=>$all]);
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
        $rolenew= new Role;
        $rolenew->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $rolenew->save();
        return redirect()->action('Root\RoleController@index')->with('status', 'Rol creado exitosamente');
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
        $rol = decrypt($id);
        $all = Role::find($rol);
        return view('root.rol.edit', ['all'=>$all]);

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
        $rol = decrypt($id);
        $request->validate([
            'nombre'=>'required|max:45|string'
        ]);
        $roleupdate = Role::find($rol);
        $roleupdate->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $roleupdate->save();

    return redirect()->action('Root\RoleController@index')->with('status','Rol editado existosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = decrypt($id);

        $roledelete = Role::find($rol);
        $roledelete->delete();

        return redirect()->action('Root\RoleController@index')->with('status','Rol eliminado exitosamente');

    }
}
