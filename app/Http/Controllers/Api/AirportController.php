<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AirportService;
use App\Http\Controllers\Controller;
use App\Http\Resources\AirportResource;

class AirportController extends Controller
{
    protected $airportService;

    public function __construct(AirportService $airportService)
    {
        $this->airportService = $airportService;
    }

    /**
     * Get the list of airports.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $airports = $this->airportService->getAllAirports();
        return AirportResource::collection($airports);
    }

    /**
     * Get details of a specific airport.
     *
     * @param  int  $id Airport ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $airport = $this->airportService->getAirportById($id);
        return new AirportResource($airport);
    }
}
