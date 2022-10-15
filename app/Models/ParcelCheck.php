<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParcelCheck extends Model
{
    //
    protected $fillable = ['parcelId', 'location', 'timeStamp'];
    public function parcels()
    {
        return $this->hasOne(Parcel::class,'id','parcelId');
    }
}
