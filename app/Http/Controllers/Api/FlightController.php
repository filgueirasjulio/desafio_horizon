<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\FlightService;
use App\Http\Controllers\Controller;
use App\Http\Resources\FlightResource;
use App\Http\Requests\FlightStoreRequest;

class FlightController extends Controller
{
    protected $flightService;

    public function __construct(FlightService $flightService)
    {
        $this->flightService = $flightService;
    }

      /**
     * Get the list of flights.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $flights = $this->flightService->getAllAirports();
        return FlightResource::collection($flights);
    }

    /**
     * Get details of a specific flight.
     *
     * @param  int  $id Airport ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $airport = $this->flightService->getAirportById($id);
        return new FlightResource($airport);
    }

    /**
     * Register a new flight
     *
     * @param  \App\Http\Requests\FlightStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FlightStoreRequest $request)
    {
        $flight = $this->flightService->store($request->all());

        return response()->json(new FlightResource($flight), 201);
    }

}
