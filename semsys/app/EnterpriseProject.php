<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnterpriseProject extends Model
{
    protected $fillable = [
        'enterprise_id', 'project_id',
    ];
}
