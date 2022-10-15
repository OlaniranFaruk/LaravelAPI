<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Order;
use App\Models\Parcel;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{
    public function index(Order $order, Shipment $shipment,Parcel $parcel)
    {
        //check if the Parcel value was passed, if so act accordingly to return result

        if(!empty($parcel->toArray())){
            return $parcel->flight()->get();
        }
        //in all other cases return ALL
        else{
            return Flight::simplePaginate(15);
        }
    }
    public function parcels(Request $request){

        if ($request->has('searchTrackingNumber') && $request->get('searchTrackingNumber')!==''){
            //get request key: searchTrackingNumber
            $searchTrackingNumber=$request->get('searchTrackingNumber');
            //get results by filtering on key
            $result =
                DB::table('flights')
                    ->join('parcels','flights.id','=', 'parcels.flightId')
                    ->where('trackingNumber','LIKE',$searchTrackingNumber.'%')
                    ->get();

            //if there is a result
            if (count($result)>0){
                //return found results
                return $result;
            }
            else{
                //if the result is empty
                return 'not found';
            }
        } else {
            return DB::table('flights')
                ->join('parcels','flights.id','=', 'parcels.flightId')
                ->select('parcels.id','parcels.trackingNumber','flights.flightNumber','flights.depAirport','flights.destAirport')
                ->get();
        }


    }

    public function show(Order $order, Shipment $shipment,Parcel $parcel,Flight $flight)
    {
        return $flight;
    }

    public function store(Request $request)
    {
        $flight = Flight::create($request->all());

        return response()->json($flight, 201);
    }

    public function update(Request $request, Order $order, Shipment $shipment,Parcel $parcel,Flight $flight)
    {
        $flight->update($request->all());

        return response()->json($flight, 200);
    }

    public function delete(Order $order, Shipment $shipment,Parcel $parcel,Flight $flight)
    {
        $flight->delete();

        return response()->json(null,204);
    }
}
