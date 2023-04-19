<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    public function index()
    {
        //return view with all warehouses
    }

    public function create()
    {
        //todo: display create warehouse UI
    }

    public function store(Request $request)
    {
        //todo: save the warehouse object
    }

    public function show(Warehouse $warehouse)
    {
        //TODO: return warehouse view UI
    }

    public function edit(Warehouse $warehouse)
    {
        //TODO: return warehouse edit UI
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        //TODO: assign attributes to the warehouse from the request
        $warehouse->save();
    }

    public function delete(Warehouse $warehouse)
    {
        $warehouse->delete();
    }
}
