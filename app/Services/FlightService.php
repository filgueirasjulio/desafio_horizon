<?php

namespace App\Services;

use App\Repositories\FlightRepository;

class FlightService
{
    protected $flightRepository;

    public function __construct(FlightRepository $flightRepository)
    {
        $this->flightRepository = $flightRepository;
    }

    /**
     * Get all flights.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllAirports()
    {
        return $this->flightRepository->getAll();
    }

    /**
     * Get flight by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     */
    public function getAirportById($id)
    {
        return $this->flightRepository->getById($id);
    }

    /**
     * Cadastrar um novo voo.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        return $this->flightRepository->store($data);
    }
}