<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\Store;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all();
        $stores = Store::query();

        if (!empty($filters))
        {
            if (isset($filters['name']))
                $stores = $stores->where('name', $filters['name']);


            if (isset($filters['country']) || isset($filters['state']) || isset($filters['city']))
            {
                $stores = $stores->whereHas('location', function(Builder $query) use ($filters) {
                    if (isset($filters['country'])){
                        $query->where('country', $filters['country']);
                    }
                    if (isset($filters['state'])){
                        $query->where('state', $filters['state']);
                    }
                    if (isset($filters['city'])){
                        $query->where('city', $filters['city']);
                    }
                });
            } else
            {
                $stores = $stores->with('location');
            }

            $stores = $stores->with('location')->get();
        } else
        {
            $stores=Store::with('location')->get();
        }
        return Inertia::render('Dashboard', ['stores' => $stores]);
    }

    public function create()
    {
        //todo: display create store UI
    }

    public function store(Request $request)
    {
        //todo: save the store object
    }

    public function show(Store $store)
    {
        //TODO: return store view UI
    }

    public function edit(Store $store)
    {
        //TODO: return store edit UI
    }

    public function update(Request $request, Store $store)
    {
        //TODO: assign attributes to the store from the request
        $store->save();
    }

    public function delete(Store $store)
    {
        $store->delete();
    }
}
