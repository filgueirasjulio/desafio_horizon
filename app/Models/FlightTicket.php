<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_seat_id',
        'ticket_price',
        'number'
    ];

    #relations
    public function flightSeat()
    {
        return $this->belongsTo(FlightSeat::class, 'flight_seat_id');
    }

    public function baggage()
    {
        return $this->hasOne(FlightBaggage::class, 'flight_ticket_id', 'id');
    }
    #end relations
}
