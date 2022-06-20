<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = [
        'name', 'phone', 'email', 'image', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function universityservices()
    {
       return $this->hasMany('App\UniversityService');
    }

    public function programs()
    {
       return $this->hasMany('App\Program');
    }

    public function projects()
    {
       return $this->hasMany('App\Project');
    }

    public function addressuniversities()
    {
        return $this->hasMany('App\AddressUniversity');
    }

}
