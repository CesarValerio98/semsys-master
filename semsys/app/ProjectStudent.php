<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectStudent extends Model
{
    protected $fillable = [
        'project_id', 'student_id',
    ];
}
