<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionController extends Controller
{
    public function index()
    {
        //return view with all promotions
    }

    public function create()
    {
        //todo: display create promotion UI
    }

    public function store(Request $request)
    {
        //todo: save the promotion object
    }

    public function show(Promotion $promotion)
    {
        //TODO: return promotion view UI
    }

    public function edit(Promotion $promotion)
    {
        //TODO: return promotion edit UI
    }

    public function update(Request $request, Promotion $promotion)
    {
        //TODO: assign attributes to the promotion from the request
        $promotion->save();
    }

    public function delete(Promotion $promotion)
    {
        $promotion->delete();
    }
}
