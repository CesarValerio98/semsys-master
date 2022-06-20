<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'requeriments', 'position', 'type', 'description', 'test_link', 'enterprise_id',
    ];

    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise', 'enterprise_id');
    }

}
