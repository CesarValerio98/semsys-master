<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\University;
use App\User;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = University::all();
        return view('root.university.index', ['all'=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all = User::all();
        return view('root.university.create', ['all'=>$all]);
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
            'nombre' => 'required|max:200|string',
            'telefono' => 'required|max:20',
            'email' => 'required|string|email|max:100|unique:universities,email',
            'imagen' => 'required|image|max:1000',
            'a_cargo' => 'required|numeric|digits_between:1,20',
        ]);

        $file = $request->file('imagen')->store('universities');
        $universitynew = new University;
        $universitynew->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $universitynew->phone = $request->telefono;
        $universitynew->email = $request->email;
        $universitynew->image = $file;
        $universitynew->user_id = $request->a_cargo;
        $universitynew->save();

        return redirect()->action('Root\UniversityController@index')->with('status','Universidad creada exitosamente');
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
        $university = decrypt($id);
        $all = University::find($university);
        $all2 = User::all();
        return view('root.university.edit', ['all'=>$all, 'all2'=>$all2]);
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
        $university = decrypt($id);
        $request->validate([
            'nombre' => 'required|max:200|string',
            'telefono' => 'required|max:20',
            'email' => 'required|string|email|max:100|unique:universities,email,'.$university,
            'imagen' => 'nullable|image|max:1000',
            'a_cargo' => 'required|numeric|digits_between:1,20',
        ]);
        
        $universityupdate = University::find($university);
        $universityupdate->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $universityupdate->phone = $request->telefono;
        $universityupdate->email = $request->email;
        if(isset($request->imagen)) {
            $file = $request->file('imagen')->store('universities');
            $universityupdate->image = $file;
        }
        $universityupdate->user_id = $request->a_cargo;
        $universityupdate->save();

        return redirect()->action('Root\UniversityController@index')->with('status','Universidad editada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $university = decrypt($id);

        $universitydelete = University::find($university);
        $universitydelete->delete();
        
        return redirect()->action('Root\UniversityController@index')->with('status','Universidad eliminada exitosamente');
    }
}
