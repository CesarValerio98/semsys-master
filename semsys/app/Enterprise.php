<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    protected $fillable = [
        'name', 'phone', 'email', 'description', 'image','user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function enterpriseservices()
    {
       return $this->hasMany('App\EnterpriseService');
    }

    public function addressenterprise()
    {
        return $this->hasOne('App\AddressEnterprise');
    }

    public function vacancies()
    {
        return $this->hasMany('App\Vacancy');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Project', 'enterprise_projects', 'enterprise_id', 'project_id')->withTimestamps();
    }

}
