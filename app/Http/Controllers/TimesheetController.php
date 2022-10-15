<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function index()
    {
        return Timesheet::all();
    }

    public function show(Timesheet $timesheet)
    {
        return $timesheet;
    }

    public function store(Request $request)
    {
        $timesheet = Timesheet::create($request->all());

        return response()->json($timesheet, 201);
    }

    public function update(Request $request, Timesheet $timesheet)
    {
        $timesheet->update($request->all());

        return response()->json($timesheet, 200);
    }

    public function delete(Timesheet $timesheet)
    {
        $timesheet->delete();

        return response()->json(null,204);
    }
}
