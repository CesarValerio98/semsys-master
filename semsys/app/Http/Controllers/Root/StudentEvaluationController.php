<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Evaluation;

class StudentEvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $student = decrypt($id);
        $all = Student::find($student);
        return view('root.university.evaluation.create', ['all'=>$all]);
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
            'evaluacion' => 'required|max:50|string',
            'archivo_evaluacion' => 'required|mimes:pdf|max:10000',
        ]);

        $file = $request->file('archivo_evaluacion')->store('evaluation');

        $evaluationnew = new Evaluation;
        $evaluationnew->name = mb_convert_case($request->evaluacion, MB_CASE_TITLE,"UTF-8");
        $evaluationnew->file = $file;
        $evaluationnew->student_id = decrypt($request->student);
        $evaluationnew->save();

        return redirect()->action('Root\StudentEvaluationController@show', [$request->student])->with('status', 'Evaluación creada exitosamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = decrypt($id);
        $exists = Evaluation::where('student_id',$student)->exists();
        $all = Student::find($student);
        if ($exists >= '1') {
            $evaluations = Evaluation::where('student_id',$student)->get();
            return view('root.university.evaluation.show', ['all'=>$all,'evaluations'=>$evaluations]);
        }else{
            return view('root.university.evaluation.create', ['all'=>$all]);
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
        $evaluation = decrypt($id);
        $all = Evaluation::find($evaluation);

        return view('root.university.evaluation.edit', ['all'=>$all]);
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
        $request->validate([
            'evaluacion' => 'required|max:50|string',
            'archivo_evaluacion' => 'nullable|mimes:pdf|max:10000',
        ]);

        $eval = decrypt($id);

        $evaluationupdt = Evaluation::find($eval);
        $evaluationupdt->name = mb_convert_case($request->evaluacion, MB_CASE_TITLE,"UTF-8");
        if(isset($request->archivo_evaluacion)) {
            $file = $request->file('archivo_evaluacion')->store('evaluation');
            $evaluationupdt->file = $file;
        }
        $evaluationupdt->save();

        return redirect()->action('Root\StudentEvaluationController@show', [encrypt($evaluationupdt->student_id)])->with('status', 'Evaluación editada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evaluation = decrypt($id);

        $evaluationedelete = Evaluation::find($evaluation);
        $evaluationedelete->delete();

        return redirect()->action('Root\StudentEvaluationController@show', [encrypt($evaluationedelete->student_id)])->with('status', 'Evaluación eliminada exitosamente');
    }
}
