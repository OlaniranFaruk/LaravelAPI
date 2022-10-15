<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Employee;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Employee $employee)
    {
        if(!empty($employee->toArray())){
            return $employee->jobs()->get();

        }
        return Job::all();
    }

    public function show(Job $job, Employee $employee)
    {
        return $job;
    }

    public function store(Request $request)
    {
        $job = Job::create($request->all());

        return response()->json($job, 201);
    }

    public function update(Request $request, Job $job, Employee $employee)
    {
        $job->update($request->all());

        return response()->json($job, 200);
    }

    public function delete(Job $job, Employee $employee)
    {
        $job->delete();

        return response()->json(null,204);
    }
}
