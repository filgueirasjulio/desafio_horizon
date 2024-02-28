<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightBaggage extends Model
{
    use HasFactory;

    protected $table = 'flight_baggages';
    
    protected $fillable = [
        'flight_ticket_id',
        'needs_dispatch',
        'baggage_weight',
    ];

    public function flightSeat()
    {
        return $this->belongsTo(FlightSeat::class);
    }
}
