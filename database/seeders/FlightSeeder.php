<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Flight;
use App\Models\Airport;
use App\Models\FlightSeat;
use App\Services\FlightService;
use Illuminate\Database\Seeder;
use App\Services\FlightSeatService;

class FlightSeeder extends Seeder
{
    protected $flightService;
    protected $flightSeatService;

    public function __construct(FlightService $flightService, FlightSeatService $flightSeatService)
    {
        $this->flightService = $flightService;
        $this->flightSeatService = $flightSeatService;
    }

    public function run()
    {
        $numberOfFlights = 50;

        $airportIds = Airport::pluck('id')->toArray();

        for ($i = 0; $i < $numberOfFlights; $i++) {
            $originAirportId = $this->getRandomAirportId($airportIds);
            $destinationAirportId = $this->getRandomAirportId($airportIds, $originAirportId);

            $flightData = [
                'airport_origin_id' => $originAirportId,
                'airport_destination_id' => $destinationAirportId,
                'flight_date' => now()->addDays(random_int(1, 30))->format('d/m/Y'),
                'departure_time' => now()->addHours(random_int(1, 12))->format('H:i:s'),
                'flight_classes' => [
                    ['class' => random_int(1, 2), 'limit' => 5],
                    ['class' => random_int(3, 4), 'limit' => 5]
                ],
                'seats_qty' => 10
            ];

            $flight = $this->flightService->store($flightData);
            
            // Após criar o voo, criar os assentos
            $this->flightSeatService->createSeatsForFlight($flight->id, $flightData['seats_qty'], $flightData['flight_classes']);
        }
        
    }

    protected function getRandomAirportId(array $airportIds, $excludeId = null)
    {
        $availableIds = array_diff($airportIds, [$excludeId]);

        return $availableIds[array_rand($availableIds)];
    }
}
