<?php

namespace App\Http\Controllers;

use App\Events\NewBid;
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

        //return dd($request);

        $bid = new Bid();
        $bid->user_id = Auth::user()->id;
        $bid->lot_id = $lot;
        $bid->price = $request->price;
        $bid->save();

        return redirect()->route('lot.show', $lot);
    }

    public function vShow(Lot $lot)
    {
        $bids = json_encode($lot->bids);
        //$lot = json_encode($lot);

        //return dd($lot);

        return view('vue.lot-show', [
            'lot' => $lot,
            'bids' => $bids
        ]);
    }

    public function getBids(Lot $lot)
    {
    	return response()->json(
    		$lot->bids()->with('user')->latest()->take(5)->get()
		);
    }

    public function postBid(Lot $lot)
    {

        $bid = $lot->bids()->create([
            'price' => request('price'),
            'user_id' => Auth()->user()->id,
            'lot_id' => $lot->id
        ]);
    
        $bid = Bid::where('id', $bid->id)->with('user')->first();
    
        broadcast(new NewBid($bid))->toOthers();
    
        return $bid;

    }
}
