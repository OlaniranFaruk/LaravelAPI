<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Parcel;
use App\Models\Shipment;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Empty_;
use function Psy\debug;

class ParcelController extends Controller
{
    public function index(Request $request,Order $order,Shipment $shipment)
    {
        if ($request->has('searchTrackingNumber') && $request->get('searchTrackingNumber')!==''){
            //get request key: searchTrackingNumber
            $searchTrackingNumber=$request->get('searchTrackingNumber');
            //get results by filtering on key
            $parcels = Parcel::where('trackingNumber','=',$searchTrackingNumber)->get();
            //if there is a result
            if (count($parcels)>0){
                //return found results
                return $parcels;
            }
            else{
                //if the result is empty
                return 'not found';
            }
        }
        //check if the searchLikeTrackingNr value was passed, if so act accordingly to return result
        if ($request->has('searchLikeTrackingNr') && $request->get('searchLikeTrackingNr')!=''){
            //get request key: searchLikeTrackingNr
            $searchTrackingNumber=$request->get('searchLikeTrackingNr');
            //get results by filtering on LIKE key
            $parcels = Parcel::where('trackingNumber','LIKE',$searchTrackingNumber.'%')->get();
            //if there is a result
            if (count($parcels)>0){
                //return found results
                return $parcels;
            }
            else{
                //if the result is empty
                return 'not found';
            }
        }
        //if parameter shipmentId is present and not empty
        if ($request->has('shipmentId') && $request->get('shipmentId')!==''){
            //get request key: searchTrackingNumber
            $searchShipmentId=$request->get('shipmentId');
            //get results by filtering on key
            $parcels = Parcel::where('shipmentId','=',$searchShipmentId)->get();
            //if there is a result
            if (count($parcels)>0){
                //return found results
                return $parcels;
            }
            else{
                //if the result is empty
                return 'not found';
            }
        }
        //check if the order value was passed, if so act accordingly to return result

        elseif(!empty($shipment->toArray())){
            return $shipment->parcels()->get();

        }
        //in all other cases return ALL
        else{
            return Parcel::simplePaginate(15);

        }
    }

    public function show(Order $order,Shipment $shipment,Parcel $parcel)
    {
        return $parcel;
    }

    public function store(Request $request)
    {
        $parcel = Parcel::create($request->all());

        return response()->json($parcel, 201);
    }

    public function update(Request $request, Order $order,Shipment $shipment,Parcel $parcel)
    {
        $parcel->update($request->all());

        return response()->json($parcel, 200);
    }

//    public function delete(Order $order,Parcel $parcel)
//    {
//        $parcel->delete();
//
//        return response()->json(null,204);
//    }
    public function destroy(Order $order,Shipment $shipment,Parcel $parcel)
    {
        $old = $parcel->toArray();

        $parcel->custom()->delete();
        $parcel->parcelCheck()->delete();
        $parcel->delete();

        return response()->json(null,204);
    }
}
