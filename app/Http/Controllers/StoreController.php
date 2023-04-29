<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\Store;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all();
        $stores = Store::query();
        $location= Location::query();

        if (!empty($filters))
        {
            if (isset($filters['name']))
                $stores = $stores->where('name', $filters['name']);

            if (isset($filters['country'])){
                $location= $location->where('country', $filters['country']);
                $stores= $stores->where('location_id', $location['id']);
            }
            if (isset($filters['state'])){
                $location= $location->where('state', $filters['state']);
                $stores= $stores->where('location_id', $location['id']);
            }
            if (isset($filters['city'])){
                $location = $location->where('city',$filters['city']);
                $stores = $stores->where('location_id', $location['id']);
            }

            $stores = $stores->get();
        } else
        {
            // $stores = Store::all();
            // $location = $location->where('id',$stores['location_id']);
            // $location=Location::all();
            $stores=Store::all();
            $location=Location::with('stores')->where('id',$stores->location_id)->get();
            $stores = ['name' => $stores['name'], 'city' => $location['city'],
                        'state' => $location['state'], 'country' => $location('country'),
                        'status'=> $stores['status'] ];
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
