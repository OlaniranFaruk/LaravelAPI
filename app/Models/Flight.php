<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    //
    protected $fillable = [
        'flightNumber',
        'depAirport',
        'destAirport',
        'reservedWeight',
        'deptTime',
        'arrivalTime',
        'reservedVolume',
        'airlineName'];
    public function parcels()
    {
        return $this->hasMany(Parcel::class,'flightId','id');
    }

}
