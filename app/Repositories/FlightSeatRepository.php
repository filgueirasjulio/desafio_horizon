<?php

namespace App\Repositories;

use App\Models\FlightSeat;
use App\Services\FlightSeatService;
use App\Services\FlightTicketService;

class FlightSeatRepository
{
    protected $model;
    protected  $flightTicketService;

    public function __construct(FlightSeat $model, FlightTicketService $flightTicketService)
    {
        $this->model = $model;
        $this->flightTicketService = $flightTicketService;
    }

    public function findById($flightId)
    {
        return $this->model->find($flightId);
    }

    public function createSeatsForFlight($flightId, $seatQty, $flightClasses)
    {
        $seatsData = [];

        foreach ($flightClasses as $class) {

            for ($i = 1; $i <= $class['limit']; $i++) {
                $seatsData[] = [
                    'flight_id' => $flightId,
                    'seat_number' => $i,
                    'is_occupied' => false,
                    'travel_class_id' => $class['class'],
                    'travel_flight' => config('enums.travel_classes.status')[$class['class']],
                ];
              
                //assento
                $seat = $this->model->create($seatsData[0]);
             
                //passagem
                $ticket = $this->flightTicketService->create($seat);
            }
        }

    }
}