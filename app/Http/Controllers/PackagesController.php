<?php

namespace App\Http\Controllers;

use App\Models\Packages;
use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    //
    public function index()
    {
        return Packages::all();
    }

    public function show(Packages $id)
    {
        return $id;
    }
    public function store(Request $request)
    {
        $id = Packages::create($request->all());

        return response()->json($id, 201);
    }
    public function update(Request $request, Packages $id)
    {
        $id->update($request->all());

        return response()->json($id, 200);
    }
    public function delete(Packages $id)
    {
        $id->delete();

        return response()->json(null,204);
    }
}
