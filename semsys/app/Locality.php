<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    protected $fillable = [
        'name', 'municipality_id'
    ];

    public function addressenterprise()
    {
        return $this->hasOne('App\AddressEnterprise');
    }

    public function municipality()
    {
        return $this->belongsTo('App\Municipality', 'municipality_id');
    }

    public function addressuniversities()
    {
        return $this->hasMany('App\AddressUniversity');
    }
}
