<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    public function index()
    {
        //return view with all stores
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
