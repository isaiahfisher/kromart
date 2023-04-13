<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        //return view with all employees
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
        //TODO: return employee view UI
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
