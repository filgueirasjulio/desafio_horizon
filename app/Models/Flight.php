<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'airport_origin_id',
        'airport_destination_id',
        'flight_number',
        'flight_date',
        'departure_time',
        'seats_qty',
        'iata_code'
    ];

    #relations
    public function airportOrigin()
    {
        return $this->belongsTo(Airport::class, 'airport_origin_id');
    }

    public function airportDestination()
    {
        return $this->belongsTo(Airport::class, 'airport_destination_id');
    }
    
    public function classes()
    {
        return $this->belongsToMany(TravelClass::class, 'flight_classes', 'flight_id', 'travel_class_id');
    }

    public function seats()
    {
        return $this->hasMany(FlightSeat::class, 'flight_id');
    }
    #end relations
}
