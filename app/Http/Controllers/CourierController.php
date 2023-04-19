<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;

class CourierController extends Controller
{
    public function index()
    {
        //return view with all couriers
    }

    public function create()
    {
        //todo: display create courier UI
    }

    public function store(Request $request)
    {
        //todo: save the courier object
    }

    public function show(Courier $courier)
    {
        //TODO: return courier view UI
    }

    public function edit(Courier $courier)
    {
        //TODO: return courier edit UI
    }

    public function update(Request $request, Courier $courier)
    {
        //TODO: assign attributes to the courier from the request
        $courier->save();
    }

    public function delete(Courier $courier)
    {
        $courier->delete();
    }
}
