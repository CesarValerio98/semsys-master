<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressEnterprise extends Model
{
    protected $fillable = [
        'street', 'zip_code', 'number', 'description', 'longitude', 'latitude', 'enterprise_id', 'locality_id',
    ];

    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise', 'enterprise_id');
    }

    public function locality()
    {
        return $this->belongsTo('App\Locality', 'locality_id');
    }
}
