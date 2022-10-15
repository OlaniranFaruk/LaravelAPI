<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        return Faq::all();
    }

    public function show(Faq $faq)
    {
        return $faq;
    }

    public function store(Request $request)
    {
        $faq = Faq::create($request->all());

        return response()->json($faq, 201);
    }

    public function update(Request $request, Faq $faq)
    {
        $faq->update($request->all());

        return response()->json($faq, 200);
    }

    public function delete(Faq $faq)
    {
        $faq->delete();

        return response()->json(null,204);
    }
}
