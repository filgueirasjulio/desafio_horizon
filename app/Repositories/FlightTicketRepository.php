<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Flight;
use App\Models\FlightSeat;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\FlightTicket;
use App\Services\FlightSeatService;
use Illuminate\Support\Facades\Hash;

class FlightTicketRepository
{
    protected $model;
    protected $flightSeatRepository;
    protected static ?string $password;

    public function __construct(FlightTicket $model)
    {
        $this->model = $model;
    }

    public function findById($id)
    {
        return $this->model->find($id);
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

    public function create(FlightSeat $seat)
    {
      //$seat = $this->flightSeatRepository->findById($data['flight_seat_id']);

      $data = [
        'flight_seat_id' => $seat->id,
        'ticket_price' => config('enums.travel_classes.prices')[$seat->travel_class_id]
      ];

       return  $this->model->create($data);
    }

    
    public function buyTicket(array $data)
    {
        $ticket = $this->findById($data['flight_ticket_id']);
        $passenger = null;

        //caso a passagem não seja pro próprio usuario, verificamos se a pessoa já está cadastrada.
        if(!isset($data['passenger_id'])) {
            $passenger = User::where('cpf', $data['passenger_cpf'])->first();
            if(!$passenger) {
                $passenger = User::create([
                    'name' => $data['passenger_name'],
                    'email' => $data['passenger_email'],
                    'email_verified_at' => now(),
                    'password' => static::$password ??= Hash::make($data['passenger_cpf']),
                    'remember_token' => Str::random(10),
                    'birth' => convertBrDateToUs($data['passenger_birth']) ,
                    'cpf' =>  $data['passenger_cpf'],
                ]);     
            }
    
        }

        $passenger_id = $passenger ? $passenger->id : $data['passenger_id'];
      
        $ticket->flightSeat->update([
            'is_occupied' => $data['cancel_order'] ? 0 : 1,
            'passenger_id' => $data['cancel_order'] ? null : $passenger_id
        ]);

        return $ticket;
    }
}