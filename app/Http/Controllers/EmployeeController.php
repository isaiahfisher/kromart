<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Illuminate\Support\Carbon;


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

    public function update(Request $request, $id)
    {
        // $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        // $request->user()->save();
        // Log::info($request->all());
        // Log::info($employee::find($employee->id));

        Log::info($request->all());
        Log::info($id);
        $firstname = $request->firstname;
        $lname= $request->lname;
        $salary=$request->salaray;
        $termination=$request->termination;
        $termReason=$request->termReason;
        $position=$request->position;
        $employee=Employee::find($id);
        if(isset($firstname)){
            $employee->firstname=$firstname;
        };
        if(isset($lastname)){
            $employee->lastname=$lastname;
        }
        if(isset($salary))
            $employee->salary=$salary;
        if(isset($termination)){
            if($termination == "y" || $termination == "Y"){
                $employee->termination_date= Carbon::now();
            }
        }
        if(isset($termReason))
            $employee->termination_reason=$termReason;
        if(isset($position))
            $employee->title=$position;
        $employee->save();
        // $firstname = $request->firstname;
        // $employee->isDirty('firstname');
        // $employee->isDirty('lastname');
        // $employee->isDirty('personal_email');
        // $employee->isDirty('ssn');
        // $employee->isDirty('salary');

        // $employee->isDirty('location_id');
        // $employee->isDirty('hire_date');
        // $employee->isDirty('termination_date');

        // $employee->isDirty('termindation_reason');



        // $employee->lastname=$firstname;
        // $employee->save();
        // $employee->save();
        //TODO: assign attributes to the employee from the request
        // $test=$employee->i
        // $student->name = $request->input('name');
        return Redirect::route('dashboard');
    }

    public function delete(Employee $employee)
    {
        Log::info($employee->all());
        $employee->delete();
        return response('OK', 200);
    }


}
