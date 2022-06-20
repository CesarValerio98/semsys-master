<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'name', 'area', 'approach', 'type', 'grade', 'image', 'modality_id', 'system_id','university_id',
    ];

    public function university()
    {
        return $this->belongsTo('App\University', 'university_id');
    }

    public function modalities()
    {
        return $this->hasMany('App\Modality');
    }

    public function systems()
    {
        return $this->hasMany('App\System');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student', 'program_students', 'program_id', 'student_id')->withTimestamps();
    }

    public function modality()
    {
        return $this->belongsTo('App\Modality', 'modality_id');
    }

    public function system()
    {
        return $this->belongsTo('App\System', 'system_id');
    }

}
