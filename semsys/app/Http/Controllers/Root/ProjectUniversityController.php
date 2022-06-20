<?php

namespace App\Http\Controllers\Root;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use App\ProjectStudent;
use App\Student;
use App\University;

class ProjectUniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Project::all();
        return view('root.university.project.index',['all'=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all = Student::all();
        $all2 = University::all();
        return view('root.university.project.create',['all'=>$all, 'all2'=>$all2]);
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
            'progreso' => 'required|max:45|string',
            'palabras_clave' => 'required|max:45|string',
            'descripcion' => 'required|max:255',
            'universidad'=> 'required|numeric|digits_between:1,20',
        ]);

        $data = $request->all();
        $insert = array();

        foreach($data['estudiantes'] as $key => $rating) {
            $insert[$key]['estudiantes'] = $rating;
        }

        foreach ($insert as $key2) {
            Validator::make($key2, [
                'estudiantes' => 'required|numeric|digits_between:1,20',
           ])->validate();
        }

        $projectnew = new Project;
        $projectnew->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $projectnew->progress = mb_convert_case($request->progreso, MB_CASE_TITLE,"UTF-8");
        $projectnew->keywords =  mb_convert_case($request->palabras_clave, MB_CASE_TITLE,"UTF-8");
        $projectnew->description = $request->descripcion;
        $projectnew->university_id = $request->universidad;
        $projectnew->save();

        foreach ($insert as $key) {
            $projectstudentnew = new ProjectStudent;
            $projectstudentnew->student_id = $key['estudiantes'];
            $projectstudentnew->project_id = $projectnew->id;
            $projectstudentnew->save();
        }

        return redirect()->action('Root\ProjectUniversityController@index')->with('status', 'Proyecto creado exitosamente');

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
        $project = decrypt($id);
        $all = Student::all();
        $all2 = University::all();
        $all3 = Project::find($project);
        $all4 = ProjectStudent::where('project_id',$project)->get();
        return view('root.university.project.edit',['all'=>$all, 'all2'=>$all2, 'all3'=>$all3, 'all4'=>$all4]);
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
        $project = decrypt($id);
        $request->validate([
            'nombre' => 'required|max:60|string',
            'progreso' => 'required|max:45|string',
            'palabras_clave' => 'required|max:45|string',
            'descripcion' => 'required|max:255',
            'universidad'=> 'required|numeric|digits_between:1,20',
        ]);

        $data = $request->all();
        $insert = array();

        foreach($data['estudiantes'] as $key => $rating) {
            $insert[$key]['estudiantes'] = $rating;
        }

        foreach ($insert as $key2) {
            Validator::make($key2, [
                'estudiantes' => 'required|numeric|digits_between:1,20',
           ])->validate();
        }

        $projectupt = Project::find($project);
        $projectupt->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $projectupt->progress = mb_convert_case($request->progreso, MB_CASE_TITLE,"UTF-8");
        $projectupt->keywords =  mb_convert_case($request->palabras_clave, MB_CASE_TITLE,"UTF-8");
        $projectupt->description = $request->descripcion;
        $projectupt->university_id = $request->universidad;
        $projectupt->save();

        $students = ProjectStudent::select('student_id')->where([['project_id',$project]])->get();

        foreach ($students as $valor) {
            $students2[] = $valor->student_id;
        }

        if (empty($students2)) {

        }else{
            $collection = collect($students2);
            $diff = $collection->diff($data['estudiantes']);
            $diff->all();

            foreach ($diff as $valor2) {
                ProjectStudent::where([['project_id',$project],['student_id',$valor2]])->delete();
            }
        }

        foreach ($insert as $key) {
            
            $count = ProjectStudent::where([['project_id',$project],['student_id',$key['estudiantes']]])->count();

            if ($count=='1') {
                # code...
            }else{
                $projectstudentnew = new ProjectStudent;
                $projectstudentnew->student_id = $key['estudiantes'];
                $projectstudentnew->project_id = $project;
                $projectstudentnew->save();
            }
        }

        return redirect()->action('Root\ProjectUniversityController@index')->with('status', 'Proyecto editado exitosamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = decrypt($id);

        $projectdelete = Project::find($project);
        $projectdelete->delete();

        return redirect()->action('Root\ProjectUniversityController@index')->with('status', 'Proyecto eliminado exitosamente');
    }
}
