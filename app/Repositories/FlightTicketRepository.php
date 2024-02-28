<?php

namespace App\Repositories;

use App\Models\Flight;
use App\Models\FlightSeat;
use App\Models\FlightTicket;
use App\Services\FlightSeatService;

class FlightTicketRepository
{
    protected $model;
    protected $flightSeatRepository;

    public function __construct(FlightTicket $model, FlightSeatRepository $flightSeatRepository)
    {
        $this->model = $model;
        $this->flightSeatRepository = $flightSeatRepository;
    }

    public function getTickets(array $data)
    {

        $collection = $this->model
            ->whereHas('flightSeat', function ($subQuery) {
                $subQuery->where('is_occupied', 0);
            })
            ->when(isset($data['travel_class']), function ($query) use ($data) {
                $query->whereHas('flightSeat', function($subQuery) use ($data) {
                    $subQuery->where('travel_class_id', $data['travel_class']);
                });
            })->when(isset($data['flight_date']), function ($query) use ($data) {
                $query->whereHas('flightSeat.flight', function($subQuery) use ($data) {
                    $subQuery->where('flight_date', convertBrDateToUs($data['flight_date']));
                });
            })->when(isset($data['flight_date_interval']), function ($query) use ($data) {
                $dates = convertArrayBrDateToUs($data['flight_date_interval']);
                $query->whereHas('flightSeat.flight', function($subQuery) use ($dates) {
                    $subQuery->whereBetween('flight_date', [$dates['start'], $dates['end']]);
                });
            })->when(isset($data['airport_origin_id']), function ($query) use ($data) {
                $query->whereHas('flightSeat.flight', function($subQuery) use ($data) {
                    $subQuery->where('airport_origin_id', $data['airport_origin_id']);
                });
            })->when(isset($data['airport_destination_id']), function ($query) use ($data) {
                $query->whereHas('flightSeat.flight', function($subQuery) use ($data) {
                    $subQuery->where('airport_destination_id', $data['airport_destination_id']);
                });
            })->when(isset($data['airport_origin_city']), function ($query) use ($data) {
                $query->whereHas('flightSeat.flight.airportOrigin', function($subQuery) use ($data) {
                    $subQuery->where('city', $data['airport_origin_city']);
                });
            })->when(isset($data['airport_destination_city']), function ($query) use ($data) {
                $query->whereHas('flightSeat.flight.airportDestination', function($subQuery) use ($data) {
                    $subQuery->where('city', $data['airport_destination_city']);
                });
            })
        ->paginate(50);

        return $collection;
    }

    public function create(array $data)
    {
      dd("oiii");
      $seat = $this->flightSeatRepository->findById($data['flight_seat_id']);

      dd($seat);
    }
}