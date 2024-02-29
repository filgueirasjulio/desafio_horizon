<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\FlightTicket;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\FlightTicketService;
use App\Http\Resources\FlightTicketResource;
use App\Exceptions\InvalidFlightTimeException;
use App\Http\Requests\FlightTicketStoreRequest;
use App\Http\Requests\FlightTicketCancelRequest;
use App\Http\Resources\FlightTicketVoucherResource;

class FlightTicketController extends Controller
{
    protected $flightTicketService;

    public function __construct(FlightTicketService $flightTicketService)
    {
        $this->flightTicketService = $flightTicketService;
    }

    /**
     * Get the list of tickets.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $tickets = $this->flightTicketService->index($request->all());

        return FlightTicketResource::collection($tickets);
    }

    
    /**
     * Get ticket.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(FlightTicket $ticket)
    {
        $ticket = $this->flightTicketService->show($ticket);

        return response()->json(new FlightTicketResource($ticket));
    }

    /**
     * Get ticket.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function voucher(FlightTicket $ticket)
    {
        try {
            $flightDate = Carbon::parse($ticket->flightSeat->flight->flight_date);
            $departureTime = Carbon::parse($ticket->flightSeat->flight->departure_time);
            $currentTime = Carbon::now();
    
            // Verificar se a data do voo é hoje e o horário tem menos de 5 horas de diferença
                if ($flightDate->isToday() && $currentTime->diffInHours($departureTime) < 5) {
                throw new InvalidFlightTimeException('O voo está muito próximo. Não é possível emitir voucher.');
            }
            
            $ticket = $this->flightTicketService->voucher($ticket);
    
    
            return response()->json(new FlightTicketVoucherResource($ticket));
        } catch (\Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], 500);
        }

    }

    /**
     * Register a new flight
     *
     * @param  \App\Http\Requests\FlightStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function buy(FlightTicket $ticket, FlightTicketStoreRequest $request)
    {
        $flightTicket = $this->flightTicketService->buyTicket($ticket, $request->all());

        return response()->json(new FlightTicketResource($flightTicket), 201);
    }

      /**
     * Register a new flight
     *
     * @param  \App\Http\Requests\FlightStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel(FlightTicket $ticket)
    {
        $flightTicket = $this->flightTicketService->cancelTicket($ticket);

        return response()->json(new FlightTicketResource($ticket), 201);
    }
}
