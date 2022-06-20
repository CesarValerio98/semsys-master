<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'f_surname', 's_surname', 'phone', 'school_email', 'personal_email', 'cv', 'status', 'image',
    ];

    public function evaluations()
    {
        return $this->hasMany('App\Evaluation');
    }

    public function programs()
    {
        return $this->belongsToMany('App\Program', 'program_students', 'student_id','program_id')->withTimestamps();
    }

    public function projects()
    {
        return $this->belongsToMany('App\Project', 'project_students', 'student_id', 'project_id')->withTimestamps();
    }

}
