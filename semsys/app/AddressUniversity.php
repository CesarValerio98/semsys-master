<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressUniversity extends Model
{
    protected $fillable = [
        'street', 'zip_code', 'number', 'description', 'longitude', 'latitude', 'university_id', 'locality_id',
    ];

    public function university()
    {
        return $this->belongsTo('App\University', 'university_id');
    }

    public function locality()
    {
        return $this->belongsTo('App\Locality', 'locality_id');
    }
}
