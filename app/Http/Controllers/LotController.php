<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Lot;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Auth;

class LotController extends Controller
{
    public function index()
    {
        $lots = Lot::all();

        return view('lot-index', [
            'lots' => $lots
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'starting_price' => 'required|gt:10',
            'step' => 'required|gt:10',
        ]);

        $lot = Auth::user()->lots()->create($validated);

        return redirect()->route('lot.index');
    }

    public function show(Lot $lot)
    {        
        return view('lot-show', [
            'lot' => $lot
        ]);
    }

    public function bidNew(Request $request, $lot)
    {
        $validated = $request->validate([
            'price' => 'required|gt:10',
        ]);

        $bid = new Bid();
        $bid->user_id = Auth::user()->id;
        $bid->lot_id = $lot;
        $bid->price = $request->price;
        $bid->save();

        return redirect()->route('lot.show', $lot);
    }
}
