<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'name', 'file', 'student_id',
    ];

    public function student()
    {
        return $this->belongsTo('App\Student', 'student_id');
    }
}
