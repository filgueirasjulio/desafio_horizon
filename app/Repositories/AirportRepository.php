<?php

namespace App\Repositories;

use App\Models\Airport;

class AirportRepository
{    
    protected $model;

    public function __construct(Airport $model)
    {
        $this->model = $model;
    }

    /**
     * Get all airports.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->paginate(50);
    }

    /**
     * Get airport by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }
}