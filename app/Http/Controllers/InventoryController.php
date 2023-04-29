<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        Log::info($request->all());
        $validated = $request->validate([
            'store' => 'required'
        ]);        

        $filters = $request->all();
        $inventories = Inventory::whereRelation('store', 'store_id', $filters['store'])->with('items')->get();

        return Inertia::render('Inventory', ['store' => $filters['store'],'inventories' => $inventories]);


    }

    public function create()
    {
        //todo: display create inventory UI
    }

    public function store(Request $request)
    {
        //todo: save the inventory object
    }

    public function show(Inventory $inventory)
    {
        //TODO: return inventory view UI
    }

    public function edit(Inventory $inventory)
    {
        //TODO: return inventory edit UI
    }

    public function update(Request $request, Inventory $inventory)
    {
        //TODO: assign attributes to the inventory from the request
        $inventory->save();
    }

    public function delete(Inventory $inventory)
    {
        $inventory->delete();
    }
}
