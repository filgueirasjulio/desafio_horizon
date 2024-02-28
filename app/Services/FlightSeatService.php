<?php

namespace App\Services;

use App\Repositories\FlightSeatRepository;

class FlightSeatService
{
    protected $flightSeatRepository;

    public function __construct(FlightSeatRepository $flightSeatRepository)
    {
        $this->flightSeatRepository = $flightSeatRepository;
    }

    public function createSeatsForFlight($flightId, $seatQty, $flightClasses)
    {
        $this->flightSeatRepository->createSeatsForFlight($flightId, $seatQty, $flightClasses);
    }
}
