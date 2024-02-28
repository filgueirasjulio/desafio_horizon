<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FlightTicketService;
use App\Http\Resources\FlightResource;
use App\Http\Resources\FlightTicketResource;
use App\Http\Requests\FlightTicketStoreRequest;

class FlightTicketController extends Controller
{
    protected $flightTicketService;

    public function __construct(FlightTicketService $flightTicketService)
    {
        $this->flightTicketService = $flightTicketService;
    }

      /**
     * Get the list of flights.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $tickets = $this->flightTicketService->index($request->all());
       
        return FlightTicketResource::collection($tickets);
    }

      /**
     * Register a new flight
     *
     * @param  \App\Http\Requests\FlightStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FlightTicketStoreRequest $request)
    {

        $flightTicket = $this->flightTicketService->create($request->all());

        return response()->json(new FlightTicketResource($flightTicket), 201);
    }
}
