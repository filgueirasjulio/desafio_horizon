<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FlightSeat extends Model
{
    use HasFactory;

    protected $table = 'flight_seats';

    protected $fillable = [
        'flight_id', 'passenger_id', 'travel_class_id', 'travel_flight', 'seat_number', 'is_occupied',
    ];

    public function ticket()
    {
        return $this->hasOne(FlightTicket::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id', 'id');
    }

    #getters
    public function getEmptySeats()
    {
        return  $this->where('is_occupied', 0)->count();
    }

    public function getOccupiedSeats()
    {
        return  $this->where('is_occupied', 1)->count();
    }
    #endgetters
}
