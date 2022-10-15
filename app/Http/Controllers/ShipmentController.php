<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{

    public function index(Request $request,Order $order)
    {
        //if parameter orderId is present and not empty
        if ($request->has('orderId') && $request->get('orderId')!==''){
            //get request key: searchTrackingNumber
            $searchOrderId=$request->get('orderId');
            //get results by filtering on key
            $shipments = Shipment::where('orderId','=',$searchOrderId)->get();
            //if there is a result
            if (count($shipments)>0){
                //return found results
                return $shipments;
            }
            else{
                //if the result is empty
                return 'not found';
            }
        }

        //check if the order value was passed, if so act accordingly to return result
        if(!empty($order->toArray())){
            return $order->shipments()->get();
        }
        //in all other cases return ALL
        else{
            return Shipment::simplePaginate(15);
        }
    }

    public function show(Order $order,Shipment $shipment)
    {
        return $shipment;
    }

    public function store(Request $request)
    {
        $shipment = Shipment::create($request->all());

        return response()->json($shipment, 201);
    }

    public function update(Request $request, Order $order,Shipment $shipment)
    {
        $shipment->update($request->all());

        return response()->json($shipment, 200);
    }

    public function destroy(Order $order,Shipment $shipment)
    {
        $old = $shipment->toArray();
        $shipment->delete();

        return response()->json(null,204);
    }
}
