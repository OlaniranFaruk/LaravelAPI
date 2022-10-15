<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerPassword;
use Illuminate\Http\Request;

class CustomerPasswordController extends Controller
{
    public function index(Request $request, Customer $customer)
    {

        //check if the parcel value was passed, if so act accordingly to return result
        if(!empty($customer->toArray())){
            return $customer->password()->get();
        }
        else {
            return 'Customer not found';
        }

    }

    public function show($customerPassword)
    {

        return  CustomerPassword::where('id',$customerPassword);
    }

    public function store(Request $request)
    {
        $customerPassword = CustomerPassword::create($request->all());

        return response()->json($customerPassword, 201);
    }

    public function update(Request $request, $customerPassword)
    {
        CustomerPassword::where('id',$customerPassword)->update(['password' => $request->get('password')]);

        $customerPassword = CustomerPassword::where('id',$customerPassword)->get();

        return response()->json($customerPassword, 200);
    }

    public function delete(Customer $customer,CustomerPassword $customerPassword)
    {
        $customerPassword->delete();

        return response()->json(null,204);
    }
}
