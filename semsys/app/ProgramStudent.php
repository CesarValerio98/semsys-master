<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramStudent extends Model
{
    protected $fillable = [
        'program_id', 'student_id',
    ];
}
