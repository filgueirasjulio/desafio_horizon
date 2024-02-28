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
    ];

    #relations
    public function flightSeat()
    {
        return $this->belongsTo(FlightSeat::class, 'flight_seat_id');
    }

    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id', 'id');
    }
    #end relations
}
