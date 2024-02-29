<?php

namespace App\Repositories;

use App\Enums\DispatchReasonEnum;
use App\Models\User;
use App\Models\Flight;
use App\Models\FlightBaggage;
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

    public function getTickets(array $data)
    {
        $collection = $this->model
            ->when(!isset($data['passenger_cpf']), function ($query) {
            $query->whereHas('flightSeat', function ($subQuery) {
                $subQuery->where('is_occupied', 0);
                });
            })
            ->when(isset($data['passenger_cpf']), function ($query) use ($data) {
                $query->whereHas('flightSeat.passenger', function ($subQuery) use ($data) {
               
                    $subQuery->where('cpf', $data['passenger_cpf']);
                });
            })
            ->when(isset($data['travel_class']), function ($query) use ($data) {
                $query->whereHas('flightSeat', function ($subQuery) use ($data) {
                    $subQuery->where('travel_class_id', $data['travel_class']);
                });
            })->when(isset($data['flight_date']), function ($query) use ($data) {
                $query->whereHas('flightSeat.flight', function ($subQuery) use ($data) {
                    $subQuery->where('flight_date', convertBrDateToUs($data['flight_date']));
                });
            })->when(isset($data['flight_date_interval']), function ($query) use ($data) {
                $dates = convertArrayBrDateToUs($data['flight_date_interval']);
                $query->whereHas('flightSeat.flight', function ($subQuery) use ($dates) {
                    $subQuery->whereBetween('flight_date', [$dates['start'], $dates['end']]);
                });
            })->when(isset($data['airport_origin_id']), function ($query) use ($data) {
                $query->whereHas('flightSeat.flight', function ($subQuery) use ($data) {
                    $subQuery->where('airport_origin_id', $data['airport_origin_id']);
                });
            })->when(isset($data['airport_destination_id']), function ($query) use ($data) {
                $query->whereHas('flightSeat.flight', function ($subQuery) use ($data) {
                    $subQuery->where('airport_destination_id', $data['airport_destination_id']);
                });
            })->when(isset($data['airport_origin_city']), function ($query) use ($data) {
                $query->whereHas('flightSeat.flight.airportOrigin', function ($subQuery) use ($data) {
                    $subQuery->where('city', $data['airport_origin_city']);
                });
            })->when(isset($data['airport_destination_city']), function ($query) use ($data) {
                $query->whereHas('flightSeat.flight.airportDestination', function ($subQuery) use ($data) {
                    $subQuery->where('city', $data['airport_destination_city']);
                });
            })
            ->paginate(50);
          
        return $collection;
    }

    public function findById(FlightTicket $ticket)
    {
        return $ticket;
    }

    public function create(FlightSeat $seat)
    {
        $data = [
            'flight_seat_id' => $seat->id,
            'ticket_price' => config('enums.travel_classes.prices')[$seat->travel_class_id],
            'number' => generateRandomNumber()
        ];

        return  $this->model->create($data);
    }

    public function buyTicket(FlightTicket $ticket, array $data)
    {
        $passenger = null;

        //caso a passagem não seja pro próprio usuario, verificamos se a pessoa já está cadastrada.
        if (!isset($data['passenger_id'])) {
            $passenger = User::where('cpf', $data['passenger_cpf'])->first();
            if (!$passenger) {
                $passenger = User::create([
                    'name' => $data['passenger_name'],
                    'email' => $data['passenger_email'],
                    'email_verified_at' => now(),
                    'password' => static::$password ??= Hash::make($data['passenger_cpf']),
                    'remember_token' => Str::random(10),
                    'birth' => convertBrDateToUs($data['passenger_birth']),
                    'cpf' =>  $data['passenger_cpf'],
                ]);
            }
        }

        $passenger_id = $passenger ? $passenger->id : $data['passenger_id'];

        $ticket->flightSeat->update([
            'is_occupied' =>  1,
            'passenger_id' =>  $passenger_id
        ]);

        //criamos a bagagem caso não exista
        if (!$ticket->baggage) {
            $baggage = new FlightBaggage([
                'needs_dispatch' => $data['needs_dispatch'],
                'is_payied' => 1,
                'dispatch_reason_id' => DispatchReasonEnum::tamanho_da_bagagem
            ]);

            $ticket->baggage()->save($baggage);
        }

        //verificamos se é necessario despacho
        if ($data['needs_dispatch']) {
            $ticket->ticket_price =  $ticket->ticket_price + ($ticket->ticket_price / 10);
        } else {
            //verificamos se já foi solicitado um despacho previamente
            if ($ticket->baggage->needs_dispatch == 1) {
                $ticket->ticket_price =  $ticket->ticket_price - ($ticket->ticket_price / 10);
                $ticket->baggage->needs_dispatch = 0;
                $ticket->baggage->save();
            }
        };

        $ticket->save();

        return $ticket;
    }

    public function cancelTicket(FlightTicket $ticket) {
 
        //o assento fica desocupado
        $ticket->flightSeat->update([
            'is_occupied' =>  0,
            'passenger_id' => null,
        ]);

        //a bagagem é removida
        $ticket->baggage()->delete();

        return $ticket;
    }
}
