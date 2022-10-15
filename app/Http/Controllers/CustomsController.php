<?php

namespace App\Http\Controllers;

use App\Models\Custom;
use App\Models\Order;
use App\Models\Parcel;
use App\Models\Shipment;
use Illuminate\Http\Request;

class CustomsController extends Controller
{
    public function index(Order $order,Shipment $shipment,Parcel $parcel)
    {
        //check if the parcel value was passed, if so act accordingly to return result

        if(!empty($parcel->toArray())){
            return $parcel->custom()->get();
        }
        //in all other cases return ALL
        else{
            return Custom::simplePaginate(15);
        }

    }

    public function show(Order $order,Shipment $shipment,Parcel $parcel,Custom $custom)
    {
        return $custom;
    }

    public function store(Request $request)
    {
        $custom = Custom::create($request->all());

        return response()->json($custom, 201);
    }

    public function update(Request $request, Order $order,Shipment $shipment,Parcel $parcel,Custom $custom)
    {
        $custom->update($request->all());

        return response()->json($custom, 200);
    }

    public function delete(Order $order,Shipment $shipment,Parcel $parcel,Custom $custom)
    {
        $custom->delete();

        return response()->json(null,204);
    }
}
