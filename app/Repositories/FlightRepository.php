<?php

namespace App\Repositories;

use App\Models\Flight;
use App\Models\FlightClass;
use App\Services\FlightSeatService;

class FlightRepository
{
    protected $model;
    protected $flightSeatService;

    public function __construct(Flight $model, FlightSeatService $flightSeatService)
    {
        $this->model = $model;
        $this->flightSeatService = $flightSeatService;
    }


    /**
     * Get all flights.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->paginate(50);
    }

    /**
     * Get flight by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Cadastrar um novo voo.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $data['flight_number'] = generateRandomNumber();
        $data['flight_date'] = convertBrDateToUs($data['flight_date']);
    
        $flightClasses = $data['flight_classes'];
        unset($data['flight_classes']);
      
        $flight = $this->model->create($data);
     
        // Associar as classes ao voo
        foreach ($flightClasses as $item) {
            FlightClass::create([
                'flight_id' => $flight->id,
                'travel_class_id' => $item['class'],
                'seats_limit' => $item['limit']
            ]);
        }

        //adicionar os assentos
        $seats = $this->flightSeatService->createSeatsForFlight($flight->id, $data['seats_qty'], $flightClasses);

        // Retornar o voo recém-criado
        return $flight;
    }
}
