<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'aiport_origin' => [
                'id' =>  $this->airport_origin_id,
                'city' => $this->airportOrigin->city,
                'country' => $this->airportOrigin->country
            ],
            'aiport_destination' => [
                'id' =>  $this->airport_destination_id,
                'city' => $this->airportDestination->city,
                'country' => $this->airportDestination->country
            ],
            'flight_number' => $this->flight_number,
            'flight_date' => $this->flight_date,
            'departure_time' => $this->departure_time,
            'flight_classes' => $this->classes->pluck('title')->implode(', '),
            'seats' => [
                'qty' => $this->seats_qty, //total de assentos
                'is_empty' => $this->seats->filter(function ($seat) {
                    return !$seat->is_occupied;
                })->count(),
                'is_occupied' => $this->seats->filter(function ($seat) {
                    return $seat->is_occupied;
                })->count(),
                'list' => FlightSeatResource::collection($this->seats),
            ]
        ];
    }
}