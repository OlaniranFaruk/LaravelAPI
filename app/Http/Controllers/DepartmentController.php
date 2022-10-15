<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return Department::all();
    }

    public function show(Department $Department)
    {
        return $Department;
    }

    public function store(Request $request)
    {
        $Department = Department::create($request->all());

        return response()->json($Department, 201);
    }

    public function update(Request $request, Department $Department)
    {
        $Department->update($request->all());

        return response()->json($Department, 200);
    }

    public function delete(Department $Department)
    {
        $Department->delete();

        return response()->json(null,204);
    }
}
