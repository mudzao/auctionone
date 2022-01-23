<?php

namespace App\Models;

use App\Models\Bid;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'user_id',
        'starting_price',
        'step'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function getHighestBidAttribute()
    {
        if (empty($this->bids->count())) {
            return $this->starting_price;
        } else {
            return $this->bids->max('price');
        }
    }

}
