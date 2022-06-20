<?php

namespace App\Http\Controllers\Root;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\University;
use App\Program;
use App\Student;
use App\ProgramStudent;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Student::all();
        return view('root.university.student.index',['all'=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all = Program::all();
        return view('root.university.student.create',['all'=>$all]);
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
            'email_escolar' => 'required|string|email|max:100|unique:students,school_email',
            'email_personal' => 'required|string|email|max:100|unique:students,personal_email',
            'estatus' => 'required|max:50|string',
            'cv' => 'required|mimes:pdf|max:10000',
            'imagen' => 'required|max:1000',
        ]);

        $file = $request->file('imagen')->store('student');
        $file2 = $request->file('cv')->store('cv');

        $data = $request->all();
        $insert = array();

        foreach($data['programa'] as $key => $rating) {
            $insert[$key]['programa'] = $rating;
        }

        foreach ($insert as $key2) {
            Validator::make($key2, [
                'programa' => 'required|numeric|digits_between:1,20',
           ])->validate();
        }

        $studentnew = new Student;
        $studentnew->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $studentnew->f_surname = mb_convert_case($request->apellido_paterno, MB_CASE_TITLE,"UTF-8");
        $studentnew->s_surname =  mb_convert_case($request->apellido_materno, MB_CASE_TITLE,"UTF-8");
        $studentnew->phone = $request->telefono;
        $studentnew->school_email = $request->email_escolar;
        $studentnew->personal_email = $request->email_personal;
        $studentnew->cv = $file2;
        $studentnew->status = mb_convert_case($request->estatus, MB_CASE_TITLE,"UTF-8");
        $studentnew->image = $file;
        $studentnew->save();

        foreach ($insert as $key) {
            $programstudentnew = new ProgramStudent;
            $programstudentnew->program_id = $key['programa'];
            $programstudentnew->student_id = $studentnew->id;
            $programstudentnew->save();
        }

        return redirect()->action('Root\StudentController@index')->with('status', 'Estudiante creado exitosamente');

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
        $student = decrypt($id);
        $all = Program::all();
        $all2 = Student::find($student);

        $all3 = DB::table('program_students')
        ->select('programs.*','universities.name as name1','systems.name as name2','modalities.name as name3')
        ->leftJoin('programs','program_students.program_id','=','programs.id')
        ->leftJoin('universities','programs.university_id','=','universities.id')
        ->leftJoin('modalities','programs.modality_id','=','modalities.id')
        ->leftJoin('systems','programs.system_id','=','systems.id')
        ->where('student_id',$student)
        ->get();
        return view('root.university.student.edit',['all'=>$all, 'info'=>$all2, 'all3'=>$all3]);
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
        $student = decrypt($id);

        $request->validate([
            'nombre' => 'required|max:60|string',
            'apellido_paterno' => 'required|max:45|string',
            'apellido_materno' => 'required|max:45|string',
            'telefono' => 'required|max:20',
            'email_escolar' => 'required|string|email|max:100|unique:students,school_email,'.$student,
            'email_personal' => 'required|string|email|max:100|unique:students,personal_email,'.$student,
            'estatus' => 'required|max:50|string',
            'cv' => 'nullable|mimes:pdf|max:10000',
            'imagen' => 'nullable|max:1000',
        ]);

        $data = $request->all();
        $insert = array();

        foreach($data['programa'] as $key => $rating) {
            $insert[$key]['programa'] = $rating;
        }

        foreach ($insert as $key2) {
            Validator::make($key2, [
                'programa' => 'required|numeric|digits_between:1,20',
           ])->validate();
        }

        $studentup = Student::find($student);
        $studentup->name = mb_convert_case($request->nombre, MB_CASE_TITLE,"UTF-8");
        $studentup->f_surname = mb_convert_case($request->apellido_paterno, MB_CASE_TITLE,"UTF-8");
        $studentup->s_surname =  mb_convert_case($request->apellido_materno, MB_CASE_TITLE,"UTF-8");
        $studentup->phone = $request->telefono;
        $studentup->school_email = $request->email_escolar;
        $studentup->personal_email = $request->email_personal;
        if(isset($request->cv)) {
            $file2 = $request->file('cv')->store('cv');
            $studentup->cv = $file2;
        }
        $studentup->status = mb_convert_case($request->estatus, MB_CASE_TITLE,"UTF-8");
        if(isset($request->imagen)) {
            $file = $request->file('imagen')->store('student');
            $studentup->image = $file;
        }
        $studentup->save();

        $programs = ProgramStudent::select('program_id')->where([['student_id',$student]])->get();

        foreach ($programs as $valor) {
            $programs2[] = $valor->program_id;
        }

        if (empty($programs2)) {

        }else{
            $collection = collect($programs2);
            $diff = $collection->diff($data['programa']);
            $diff->all();

            foreach ($diff as $valor2) {
                ProgramStudent::where([['student_id',$student],['program_id',$valor2]])->delete();
            }
        }

        foreach ($insert as $key) {
            
            $count = ProgramStudent::where([['student_id',$student],['program_id',$key['programa']]])->count();

            if ($count=='1') {
                # code...
            }else{
                $programstudentnew = new ProgramStudent;
                $programstudentnew->program_id = $key['programa'];
                $programstudentnew->student_id = $student;
                $programstudentnew->save();
            }
        }

        return redirect()->action('Root\StudentController@index')->with('status', 'Estudiante editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = decrypt($id);

        $studentedelete = Student::find($student);
        $studentedelete->delete();

        return redirect()->action('Root\StudentController@index')->with('status','Estudiante eliminado exitosamente');
    }
}
