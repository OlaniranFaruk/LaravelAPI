<?php

namespace App\Http\Controllers;

use App\Models\JobOffers;
use Illuminate\Http\Request;

class JobOfferController extends Controller
{
    public function index()
    {
        return JobOffers::all();
    }

    public function show(JobOffers $jobOffer)
    {
        return $jobOffer;
    }

    public function store(Request $request)
    {
        $jobOffer = JobOffers::create($request->all());

        return response()->json($jobOffer, 201);
    }

    public function update(Request $request, JobOffers $jobOffer)
    {
        $jobOffer->update($request->all());

        return response()->json($jobOffer, 200);
    }

    public function delete(JobOffers $jobOffer)
    {
        $jobOffer->delete();

        return response()->json(null,204);
    }
}
