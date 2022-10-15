<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('mail') && $request->get('mail')!==''){
            //get request key: mail
            $searchMail=$request->get('mail');
            //get results by filtering on key
            $employees = Employee::where('employeeMailAddress','=',$searchMail)->get();
            //if there is a result
            if (count($employees)>0){
                //return found results
                return $employees;
            }
            else{
                //if the result is empty
                return 'not found';
            }
        }
        //in all other cases return ALL
        else{
            return Employee::all();

        }
    }

    public function show(Employee $employee)
    {
        return $employee;
    }

    public function store(Request $request)
    {
        $employee = Employee::create($request->all());

        return response()->json($employee, 201);
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());

        return response()->json($employee, 200);
    }

    public function delete(Employee $employee)
    {
        $employee->delete();

        return response()->json(null,204);
    }
}