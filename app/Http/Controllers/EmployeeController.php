<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Employee;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all();
        $employees = Employee::query();
        if (!empty($filters))
        {
            if (isset($filters['name']))
                $employees = $employees->where('firstname', $filters['name']);

            if (isset($filters['ssn']))
                $employees = $employees->where('ssn', $filters['ssn']);

            $employees = $employees->get();
        } else
        {
            $employees = Employee::all();
        }
        return Inertia::render('Employee', ['employees' => $employees]);
    }

    public function create()
    {
        //todo: display create employee UI
    }

    public function store(Request $request)
    {
        //todo: save the employee object
    }

    public function show(Employee $employee)
    {
        return Inertia::render('Employee', ['employee' => $employee]);
    }

    public function edit(Employee $employee)
    {
        //TODO: return employee edit UI
    }

    public function update(Request $request, Employee $employee)
    {
        //TODO: assign attributes to the employee from the request
        $employee->save();
    }

    public function delete(Employee $employee)
    {
        $employee->delete();
    }
}
