<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightSeatResource extends JsonResource
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
            'seat_number' => $this->seat_number,
            'is_occupied' => $this->is_occupied,
            'travel_class_id' => $this->travel_class_id,
            'travel_flight' => $this->travel_flight,
            'ticket' => new FlightTicketResource($this->ticket),
            'passenger' => new UserResource($this->passenger)
        ];
    }
}