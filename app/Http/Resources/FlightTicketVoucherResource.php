<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightTicketVoucherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
         [
            'id' => $this->id,
            'flight' => [
                'id' => $this->flightSeat->flight_id, 
                'number' => $this->flightSeat->flight->flight_number,  
                'date' => convertUsDateToBr($this->flightSeat->flight->flight_date),
                'departure_time' => $this->flightSeat->flight->departure_time,
                'airpots' => [
                    'origin' => [
                        'id' => $this->flightSeat->flight->airportOrigin->id,
                        'city' =>  $this->flightSeat->flight->airportOrigin->city,
                        'uf' =>  $this->flightSeat->flight->airportOrigin->uf,
                        'iata_code' =>  $this->flightSeat->flight->airportOrigin->iata_code,
                    ],
                    'destination' => [
                        'id' => $this->flightSeat->flight->airportDestination->id,
                        'city' =>  $this->flightSeat->flight->airportDestination->city,
                        'uf' =>  $this->flightSeat->flight->airportDestination->uf,
                        'iata_code' =>  $this->flightSeat->flight->airportDestination->iata_code,
                    ],
                    'seat' => new FlightSeatResource($this->flightSeat),
                ]
            ],
            'flight_seat_id' => $this->flightSeat->id,
            'price' => $this->ticket_price,
            'travel_class' => $this->flightSeat->travel_flight,
            'is_paid' => $this->flightSeat->is_occupied,
        ];
    }
}