<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Employee;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    public function index(Employee $employee)
    {
        if(!empty($employee->toArray())){
            return $employee->absences()->get();
        }
        else{
            return Absence::all();
        }
    }

    public function show(Employee $employee, Absence $absence)
    {
        return $absence;
    }

    public function store(Request $request, Employee $employee)
    {
        $absences = Absence::create($request->all());

        return response()->json($absences, 201);
    }

    public function update(Request $request,Employee $employee, Absence $absences)
    {
        $absences->update($request->all());

        return response()->json($absences, 200);
    }

    public function delete(Employee $employee, Absence $absences)
    {
        $absences->delete();

        return response()->json(null,204);
    }
}
