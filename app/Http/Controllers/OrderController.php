<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        //return view with all orders
    }

    public function create()
    {
        //todo: display create order UI
    }

    public function store(Request $request)
    {
        //todo: save the order object
    }

    public function show(Order $order)
    {
        //TODO: return order view UI
    }

    public function edit(Order $order)
    {
        //TODO: return order edit UI
    }

    public function update(Request $request, Order $order)
    {
        //TODO: assign attributes to the order from the request
        $order->save();
    }

    public function delete(Order $order)
    {
        $order->delete();
    }
}
