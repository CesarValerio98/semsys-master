<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnterpriseService extends Model
{
    protected $fillable = [
        'name', 'area', 'type', 'description', 'enterprise_id',
    ];

    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise', 'enterprise_id');
    }
}
