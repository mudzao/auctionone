<?php

namespace App\Models;

use App\Events\NewBid;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'price', 
        'user_id',
        'lot_id'
    ];

    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
