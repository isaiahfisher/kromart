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

        
        $inventories = Inventory::whereRelation('store', 'store_id', $filters['store']);

        $inventories = $inventories->with(['items' => function ($query) use ($filters){
            if (isset($filters['name']))
            {
                $query = $query->where('name', $filters['name']);
            }
            if (isset($filters['productid']))
            {
                $query = $query->where('sku', $filters['productid']);
            }
            if (isset($filters['minprice']))
                $query = $query->where('msrp', '>=', $filters['minprice']);
            if (isset($filters['maxprice']))
                $query = $query->where('msrp', '<=', $filters['maxprice']);
            if (isset($filters['category']))
                $query = $query->where('category', $filters['category']);
            if (isset($filters['qtt']))
                $query = $query->wherePivot('quantity', $filters['qtt']);
            if (isset($filters['exp']))
                $query = $query->wherePivot('expiry_date', $filters['exp']);
            if (isset($filters['batch']))
                $query = $query->wherePivot('batch', $filters['batch']);
        }]);

        $inventories = $inventories->get();

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
