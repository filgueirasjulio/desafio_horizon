<?php

namespace App\Services;

use App\Repositories\AirportRepository;

class AirportService
{
    protected $airportRepository;

    public function __construct(AirportRepository $airportRepository)
    {
        $this->airportRepository = $airportRepository;
    }

    /**
     * Get all airports.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllAirports()
    {
        return $this->airportRepository->getAll();
    }

    /**
     * Get airport by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     */
    public function getAirportById($id)
    {
        return $this->airportRepository->getById($id);
    }
}
