<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $fillable = [
        'name',
    ];

    public function programs()
    {
        return $this->hasMany('App\Program');
    }
}
