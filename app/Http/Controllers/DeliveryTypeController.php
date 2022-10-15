<?php

namespace App\Http\Controllers;

use App\Models\DeliveryType;
use App\Models\Flight;
use App\Models\Order;
use App\Models\Parcel;
use App\Models\Shipment;
use Illuminate\Http\Request;

class DeliveryTypeController extends Controller
{
    public function index(Order $order, Shipment $shipment)
    {
        //check if the Parcel value was passed, if so act accordingly to return result

        if(!empty($shipment->toArray())){
            return $shipment->deliveryType()->get();
        }
        //in all other cases return ALL
        else{
            return DeliveryType::all();
        }
    }

    public function show(Order $order, Shipment $shipment,Parcel $parcel,DeliveryType $deliveryType)
    {
        return $deliveryType;
    }

    public function store(Request $request)
    {
        $deliveryType = DeliveryType::create($request->all());

        return response()->json($deliveryType, 201);
    }

    public function update(Request $request, Order $order, Shipment $shipment,Parcel $parcel,DeliveryType $deliveryType)
    {
        $deliveryType->update($request->all());

        return response()->json($deliveryType, 200);
    }

    public function delete(Order $order,Shipment $shipment, Parcel $parcel,DeliveryType $deliveryType)
    {
        $deliveryType->delete();

        return response()->json(null,204);
    }
}
