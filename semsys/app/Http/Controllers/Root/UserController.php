<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = User::all();
        return view('root.user.index', ['all'=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all = Role::all();
        return view('root.user.create', ['all'=>$all]);
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
            'nombre' => 'required|max:60|string',
            'apellido_paterno' => 'required|max:45|string',
            'apellido_materno' => 'required|max:45|string',
            'telefono' => 'required|max:20',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|min:8|max:255|confirmed',
            'imagen' => 'required|image|max:1000',
            'rol' => 'required|numeric|digits_between:1,20',
        ]);

        $file = $request->file('imagen')->store('user');
        $usernew = new User;
        $usernew->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $usernew->f_surname = mb_convert_case($request->apellido_paterno, MB_CASE_TITLE,"UTF-8");
        $usernew->s_surname =  mb_convert_case($request->apellido_materno, MB_CASE_TITLE,"UTF-8");
        $usernew->phone = $request->telefono;
        $usernew->email = $request->email;
        $usernew->password = Hash::make($request->password);
        $usernew->image = $file;
        $usernew->role_id = $request->rol;
        $usernew->save();

        return redirect()->action('Root\UserController@index')->with('status','Usuario creado exitosamente');

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
        $user = decrypt($id);
        $all = User::find($user);
        $all2 = Role::all();
        return view('root.user.edit', ['all'=>$all, 'all2'=>$all2]);
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
        $user = decrypt($id);
        $request->validate([
            'nombre' => 'required|max:60|string',
            'apellido_paterno' => 'required|max:45|string',
            'apellido_materno' => 'required|max:45|string',
            'telefono' => 'required|max:20',
            'email' => 'required|string|email|max:100|unique:users,email,'.$user,
            'imagen' => 'nullable|image|max:1000',
            'rol' => 'required|numeric|digits_between:1,20',
        ]);

        $userupdate = User::find($user);
        $userupdate->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $userupdate->f_surname = mb_convert_case($request->apellido_paterno, MB_CASE_TITLE,"UTF-8");
        $userupdate->s_surname =  mb_convert_case($request->apellido_materno, MB_CASE_TITLE,"UTF-8");
        $userupdate->phone = $request->telefono;
        $userupdate->email = $request->email;
        if(isset($request->imagen)) {
            $file = $request->file('imagen')->store('user');
            $userupdate->image = $file;
        }
        $userupdate->role_id = $request->rol;
        $userupdate->save();

        return redirect()->action('Root\UserController@index')->with('status','Usuario editado exitosamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = decrypt($id);

        $userdelete = User::find($user);
        $userdelete->delete();

        return redirect()->action('Root\UserController@index')->with('status','Usuario eliminado exitosamente');
    }
}
