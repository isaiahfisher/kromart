<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        //return view with all locations
    }

    public function create()
    {
        //todo: display create location UI
    }

    public function store(Request $request)
    {
        //todo: save the location object
    }

    public function show(Location $location)
    {
        //TODO: return location view UI
    }

    public function edit(Location $location)
    {
        //TODO: return location edit UI
    }

    public function update(Request $request, Location $location)
    {
        //TODO: assign attributes to the location from the request
        $location->save();
    }

    public function delete(Location $location)
    {
        $location->delete();
    }
}
