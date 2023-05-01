<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'store' => 'required'
        ]);

        $filters = $request->all();
        $employees = Employee::whereRelation('stores', 'store_id', $filters['store']);

        if (isset($filters['firstname']))
            $employees = $employees->where('firstname', $filters['firstname']);
        if (isset($filters['lastname']))
            $employees = $employees->where('lastname', $filters['lastname']);
        if (isset($filters['ssn']))
            $employees = $employees->where('ssn', $filters['ssn']);
        if (isset($filters['salaryMin']))
            $employees = $employees->where('salary', '>=', $filters['salaryMin']);
        if (isset($filters['salaryMax']))
            $employees = $employees->where('salary', '<=', $filters['salaryMax']);
        if (isset($filters['title']))
            $employees = $employees->where('title', $filters['title']);

        $employees = $employees->get();
        return Inertia::render('Employee', ['store' => $filters['store'],'employees' => $employees]);
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
        //todo: employee show
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
        return response('OK', 200);
    }


}
