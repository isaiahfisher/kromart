<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        //return view with all items
    }

    public function create()
    {
        //todo: display create item UI
    }

    public function store(Request $request)
    {
        //todo: save the item object
    }

    public function show(Item $item)
    {
        //TODO: return item view UI
    }

    public function edit(Item $item)
    {
        //TODO: return item edit UI
    }

    public function update(Request $request, Item $item)
    {
        //TODO: assign attributes to the item from the request
        $item->save();
    }

    public function delete(Item $item)
    {
        $item->delete();
    }
}
