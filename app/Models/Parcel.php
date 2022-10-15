<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    protected $fillable = [
        'trackingNumber',
        'height',
        'width',
        'length',
        'weight',
        'flightId',
        'priority',
        'customsId',
        'isAllocated',
        'insurance',
        'shipmentId',
        'statusId',
    ];


    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'id', 'shipmentId');
    }
    public function flight() {
        return $this->hasOne(Flight::class,'id','flightId');
    }
    public function custom() {
        //return $this->belongsTo(Custom::class, 'parcelId');
        return $this->belongsTo(Custom::class,'id','id');
    }
    public function parcelCheck()
    {
        return $this->belongsTo(ParcelCheck::class, 'id', 'parcelId');
    }
    public function parcelType()
    {
        return $this->hasOne(ParcelType::class, 'id', 'parcelTypeId');
    }
    public function status()
    {
        return $this->hasOne(Status::class,'id','statusId');
    }
}
