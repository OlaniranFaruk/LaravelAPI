<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Parcel;
use App\Models\ParcelCheck;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ParcelCheckController extends Controller
{
    public function index(Order $order,Shipment $shipment, Parcel $parcel)
    {
        //check if the Parcel value was passed, if so act accordingly to return result

        if(!empty($parcel->toArray())){
            return $parcel->parcelCheck()->get();
        }
        //in all other cases return ALL
        else{
            return ParcelCheck::simplePaginate(15);
        }
    }

    public function show(Order $order,Shipment $shipment,Parcel $parcel,ParcelCheck $parcelCheck)
    {
        return $parcelCheck;
    }

    public function store(Request $request)
    {
        $parcelCheck = ParcelCheck::create($request->all());

        return response()->json($parcelCheck, 201);
    }

    public function update(Request $request, Order $order,Shipment $shipment, Parcel $parcel,ParcelCheck $parcelCheck)
    {
        $parcelCheck->update($request->all());

        return response()->json($parcelCheck, 200);
    }

    public function destroy(Order $order,Shipment $shipment, Parcel $parcel,ParcelCheck $parcelCheck)
    {
        $parcelCheck->delete();

        return response()->json(null,204);
    }
}
