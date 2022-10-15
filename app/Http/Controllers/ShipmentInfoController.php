<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shipment;
use App\Models\ShipmentInfo;
use Illuminate\Http\Request;

class ShipmentInfoController extends Controller
{
    public function index(Order $order,Shipment $shipment)
    {
        //check if the Parcel value was passed, if so act accordingly to return result

        if(!empty($shipment->toArray())){
            return $shipment->shipmentInfo()->get();
        }
        //in all other cases return ALL
        else{
            return ShipmentInfo::all();
        }
    }

    public function show(Order $order, Shipment $shipment, ShipmentInfo $shipmentInfo)
    {
        return $shipmentInfo;
    }

    public function store(Request $request)
    {
        $status = ShipmentInfo::create($request->all());

        return response()->json($status, 201);
    }

    public function update(Request $request, Order $order, Shipment $shipment, ShipmentInfo $shipmentInfo)
    {
        $shipmentInfo->update($request->all());

        return response()->json($shipmentInfo, 200);
    }

    public function delete(Order $order, Shipment $shipment, ShipmentInfo $shipmentInfo)
    {
        $shipmentInfo->delete();

        return response()->json(null,204);
    }
}
