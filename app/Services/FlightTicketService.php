<?php

namespace App\Services;

use App\Models\FlightSeat;
use App\Models\FlightTicket;
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

    public function show(FlightTicket $ticket)
    {
        return $this->flightTicketRepository->findById($ticket);
    }

    public function voucher(FlightTicket $ticket)
    {
        return $this->flightTicketRepository->findById($ticket);
    }

    public function create(FlightSeat $model)
    {
        return $this->flightTicketRepository->create($model);
    }
    
    public function buyTicket(FlightTicket $ticket, array $data)
    {
        return $this->flightTicketRepository->buyTicket($ticket, $data);
    }

    public function cancelTicket(FlightTicket $flightTicket)
    {
        return $this->flightTicketRepository->cancelTicket($flightTicket);
    }
}