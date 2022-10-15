<?php

namespace App\Http\Controllers;
use App\Models\Parcel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        return Parcel::all();
    }

    public function show(Parcel $products)
    {
        return $products;
    }

    public function store(Request $request)
    {
        $products = Parcel::create($request->all());

        return response()->json($products, 201);
    }

    public function update(Request $request, Parcel $products)
    {
        $products->update($request->all());

        return response()->json($products, 200);
    }

    public function delete(Parcel $products)
    {
        $products->delete();

        return response()->json(null,204);
    }
}
