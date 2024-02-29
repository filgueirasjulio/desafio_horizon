<?php

namespace Database\Seeders;

use App\Models\FlightSeat;
use App\Models\FlightTicket;
use Illuminate\Database\Seeder;
 

class FlightTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $class_prices = [
            1 => 1000.00,
            2 => 2000.00,
            3 => 5000.00,
            4 => 10000.00
        ];

        // Recuperar todos os assentos
        $flightSeats = FlightSeat::all();

        // Criar uma passagem para cada assento
        foreach ($flightSeats as $seat) {
            FlightTicket::create([
                'flight_seat_id' => $seat->id,
                'ticket_price' => $class_prices[$seat->travel_class_id],
                'number' => generateRandomNumber()
            ]);
        }
    }
}
