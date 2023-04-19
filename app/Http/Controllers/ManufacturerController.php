<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;

class ManufacturerController extends Controller
{
    public function index()
    {
        //return view with all manufacturers
    }

    public function create()
    {
        //todo: display create manufacturer UI
    }

    public function store(Request $request)
    {
        //todo: save the manufacturer object
    }

    public function show(Manufacturer $manufacturer)
    {
        //TODO: return manufacturer view UI
    }

    public function edit(Manufacturer $manufacturer)
    {
        //TODO: return manufacturer edit UI
    }

    public function update(Request $request, Manufacturer $manufacturer)
    {
        //TODO: assign attributes to the manufacturer from the request
        $manufacturer->save();
    }

    public function delete(Manufacturer $manufacturer)
    {
        $manufacturer->delete();
    }

}
