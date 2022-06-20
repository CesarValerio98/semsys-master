<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $fillable = [
        'name', 'state_id'
    ];

    public function localities()
    {
        return $this->hasMany('App\Locality');
    }

    public function state()
    {
        return $this->belongsTo('App\State', 'state_id');
    }
}
