<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniversityService extends Model
{
    protected $fillable = [
        'name', 'description', 'type', 'university_id',
    ];

    public function university()
    {
        return $this->belongsTo('App\University', 'university_id');
    }
}
