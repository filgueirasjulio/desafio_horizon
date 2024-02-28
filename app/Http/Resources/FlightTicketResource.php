<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightTicketResource extends JsonResource
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
            'flight_id' => $this->flightSeat->flight_id,
            'price' => $this->ticket_price,
            'travel_class' => $this->flightSeat->travel_flight,
            'is_paid' => $this->flightSeat->is_occupied,
        ];
    }
}
