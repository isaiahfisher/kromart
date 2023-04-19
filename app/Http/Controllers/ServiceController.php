<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        //return view with all services
    }

    public function create()
    {
        //todo: display create service UI
    }

    public function store(Request $request)
    {
        //todo: save the service object
    }

    public function show(Service $service)
    {
        //TODO: return service view UI
    }

    public function edit(Service $service)
    {
        //TODO: return service edit UI
    }

    public function update(Request $request, Service $service)
    {
        //TODO: assign attributes to the service from the request
        $service->save();
    }

    public function delete(Service $service)
    {
        $service->delete();
    }
}
