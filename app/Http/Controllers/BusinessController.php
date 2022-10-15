<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        //if parameter businessName is present and not empty
        if ($request->has('businessName') && $request->get('businessName')!==''){
            //get request key: businessName
            $search=$request->get('businessName');
            //get results by filtering on key
            $businesses = Business::where('businessName','=',$search)
                ->get();
            //if there is a result
            if (count($businesses)>0){
                //return found results
                return $businesses;
            }
            else{
                //if the result is empty
                return 'not found';
            }
        }else
        {
            return Business::all();
        }
    }

    public function show(Business $business)
    {
        return $business;
    }

    public function store(Request $request)
    {
        $business = Business::create($request->all());

        return response()->json($business, 201);
    }

    public function update(Request $request, Business $business)
    {
        $business->update($request->all());

        return response()->json($business, 200);
    }

    public function delete(Business $business)
    {
        $business->delete();

        return response()->json(null,204);
    }
}
