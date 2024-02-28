<?php

namespace Database\Seeders;

use App\Models\FlightBaggage;
use App\Models\FlightTicket;
use Illuminate\Database\Seeder;
 

class FlightBaggageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Recuperar todos os assentos
        $flightTickets = FlightTicket::limit(100)->get();

        // Criar uma passagem para cada assento
        foreach ($flightTickets as $ticket) {
            FlightBaggage::create([
                'flight_ticket_id' => $ticket->id,
                'dispatch_reason_id' => random_int(1, 4),
            ]);
        }
    }
}
