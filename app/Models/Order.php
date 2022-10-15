<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customerId', 'totalPrice', 'isPaid', 'extraInfo','orderNr'];

    public function shipments()
    {
        return $this->hasMany(Shipment::class, 'orderId');
    }
    public function customer()
    {
        return $this->hasOne(Customer::class,'id','customerId');
    }
}