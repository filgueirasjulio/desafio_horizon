<?php

namespace App\Services;

use App\Models\FlightSeat;
use App\Repositories\FlightTicketRepository;
use Illuminate\Http\Request;

class FlightTicketService
{
    protected $flightTicketRepository;

    public function __construct(FlightTicketRepository $flightTicketRepository)
    {
        $this->flightTicketRepository = $flightTicketRepository;
    }

    public function index(array $data)
    {
        return $this->flightTicketRepository->getTickets($data);
    }

    public function create(array $data)
    {
        return $this->flightTicketRepository->create($data);
    }
}