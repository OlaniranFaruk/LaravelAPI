<?php

namespace App\Http\Controllers;

use App\Models\JobDescription;
use Illuminate\Http\Request;

class JobDescriptionController extends Controller
{
    public function index()
    {
        return JobDescription::all();
    }

    public function show(JobDescription $jobDescription)
    {
        return $jobDescription;
    }

    public function store(Request $request)
    {
        $jobDescription = JobDescription::create($request->all());

        return response()->json($jobDescription, 201);
    }

    public function update(Request $request, JobDescription $jobDescription)
    {
        $jobDescription->update($request->all());

        return response()->json($jobDescription, 200);
    }

    public function delete(JobDescription $jobDescription)
    {
        $jobDescription->delete();

        return response()->json(null,204);
    }
}
