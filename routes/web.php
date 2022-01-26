<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'lot'], function () {
    Route::get('/', [App\Http\Controllers\LotController::class, 'index'])->name('lot.index');
    Route::view('/create', 'lot-create')->name('lot.create');
    Route::post('/store', [App\Http\Controllers\LotController::class, 'store'])->name('lot.store');
    Route::get('/{lot}', [App\Http\Controllers\LotController::class, 'show'])->name('lot.show');
    Route::post('/{lot}/bid', [App\Http\Controllers\LotController::class, 'bidNew'])->name('bid.new');
});

Route::group(['prefix' => 'vlot'], function () {
    Route::get('/', [App\Http\Controllers\LotController::class, 'index'])->name('vlot.index');
    Route::get('/{lot}', [App\Http\Controllers\LotController::class, 'vShow'])->name('v.lot.show');
    Route::post('/bid', [App\Http\Controllers\LotController::class, 'vBidNew'])->name('v.bid.new');
    Route::get('/{lot}/bids', [App\Http\Controllers\LotController::class, 'getBids'])->name('v.lot.get.bids');
    Route::get('/{lot}/highestbid', [App\Http\Controllers\LotController::class, 'getHighestBid'])->name('v.lot.get.highest.bid');
    Route::post('/{lot}/bid', [App\Http\Controllers\LotController::class, 'postBid'])->name('v.lot.post.bid');
});


