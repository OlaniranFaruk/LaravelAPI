<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function index()
    {
        return Benefit::all();
    }

    public function show(Benefit $benefit)
    {
        return $benefit;
    }

    public function store(Request $request)
    {
        $benefit = Benefit::create($request->all());

        return response()->json($benefit, 201);
    }

    public function update(Request $request, Benefit $benefit)
    {
        $benefit->update($request->all());

        return response()->json($benefit, 200);
    }

    public function delete(Benefit $benefit)
    {
        $benefit->delete();

        return response()->json(null,204);
    }
}
