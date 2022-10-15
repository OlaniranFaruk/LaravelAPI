<?php

namespace App\Http\Controllers;
use App\Models\Address;
use App\Models\Order;
use App\Models\Parcel;
use Illuminate\Http\Request;
use App\Models;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        //if parameter customerId is present and not empty
        if ($request->has('customerId') && $request->get('customerId')!==''){
            //get request key: customerId
            $searchCustomerId=$request->get('customerId');
            //get results by filtering on key
            $orders = Order::where('customerId','=',$searchCustomerId)->get();
            //if there is a result
            if (count($orders)>0){
                //return found results
                return $orders;
            }
            else{
                //if the result is empty
                return 'not found';
            }
        }
        //in all other cases return ALL
        else{
            return Order::simplePaginate(15);
        }
    }

    public function show(Order $order)
    {
        return $order;
    }

    public function store(Request $request)
    {
        $order = Order::create($request->all());

        return response()->json($order, 201);
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->all());

        return response()->json($order, 200);
    }

    public function delete(Order $order)
    {
        $order->delete();

        return response()->json(null,204);
    }
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json(null,204);
    }

//    public function parcelDetail($id, $pid)
//    {
//        $parcel = Parcel::all()
//            ->where('id',$pid);
//        return $parcel;
//    }
//
//    public function parcelDepAddress(Order $order, Parcel $parcel)
//    {
//
//        return $parcel->depAddress();
//    }
//
//    public function parcelDestAddress($id, $pid,$aid)
//    {
//        $depAddress = Address::all()
//            ->where('id',$aid);
//        return $depAddress;
//    }
//    public function parcelCustom($id, $pid,$cid)
//    {
//        $custom = Models\Custom::all()
//            ->where('id',$cid);
//        return $custom;
//    }
//    public function parcelChecks($id, $pid)
//    {
//        $parcelChecks = Models\ParcelCheck::all()
//            ->where('id',$pid);
//        return $parcelChecks;
//    }

}
