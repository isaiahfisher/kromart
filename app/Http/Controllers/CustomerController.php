<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        //return view with all customers
    }

    public function create()
    {
        //todo: display create customer UI
    }

    public function store(Request $request)
    {
        //todo: save the customer object
    }

    public function show(Customer $customer)
    {
        //TODO: return customer view UI
    }

    public function edit(Customer $customer)
    {
        //TODO: return customer edit UI
    }

    public function update(Request $request, Customer $customer)
    {
        //TODO: assign attributes to the customer from the request
        $customer->save();
    }

    public function delete(Customer $customer)
    {
        $customer->delete();
    }
}
