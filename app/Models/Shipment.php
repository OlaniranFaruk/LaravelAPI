<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'orderId',
        'statusId',
        'reason',
        'depAddressId',
        'destAddressId',
        'departureTimeStamp',
        'arrivalTimeStamp',
        'deliveryTypeId',
        ];
    public function order()
    {
        return $this->hasOne(Order::class,'id','orderId');
    }
    public function parcels()
    {
        return $this->hasMany(Parcel::class,'shipmentId','id');
    }
    public function status()
    {
        return $this->hasOne(Status::class,'id','statusId');
    }
    public function destAddress() {
        return $this->hasOne(Address::class,'id','destAddressId');
    }
    public function depAddress() {
        return $this->hasOne(Address::class,'id','depAddressId');
    }
    public function deliveryType()
    {
        return $this->hasOne(DeliveryType::class,'id','deliveryTypeId');
    }
    public function shipmentInfo()
    {
        return $this->hasOne(ShipmentInfo::class,'id','shipmentId');
    }

}
