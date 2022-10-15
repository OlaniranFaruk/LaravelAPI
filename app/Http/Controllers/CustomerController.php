<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request, Order $order)
    {
        if ($request->has('email') && $request->get('email')!==''){
            //get request key: mail
            $searchEmail=$request->get('email');
            //get results by filtering on key
            $customers = Customer::where('email','=',$searchEmail)->get();
            //if there is a result
            if (count($customers)>0){
                //return found results
                return $customers;
            }
            else{
                //if the result is empty
                return 'not found';
            }
        }
        //check if the order value was passed, if so act accordingly to return result

        elseif(!empty($order->toArray())){
            return $order->customer()->get();

        }
        //in all other cases return ALL
        else{
            return Customer::Paginate(15);

        }
    }


    public function show(Customer $customer)
    {
        return $customer;
    }

    public function store(Request $request)
    {
        $customer = Customer::create($request->all());

        return response()->json($customer, 201);
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());

        return response()->json($customer, 200);
    }

    public function delete(Customer $customer)
    {
        $customer->delete();

        return response()->json(null,204);
    }
}
