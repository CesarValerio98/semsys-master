<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modality extends Model
{
    protected $fillable = [
        'name',
    ];

    public function programs()
    {
        return $this->hasMany('App\Program');
    }
}
