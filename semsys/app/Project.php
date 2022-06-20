<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'progress', 'keywords', 'description', 'university_id',
    ];

    public function university()
    {
        return $this->belongsTo('App\University', 'university_id');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student', 'project_students', 'project_id', 'student_id')->withTimestamps();
    }

    public function enterprises()
    {
        return $this->belongsToMany('App\Enterprise', 'enterprise_projects', 'project_id', 'enterprise_id')->withTimestamps();
    }

}
