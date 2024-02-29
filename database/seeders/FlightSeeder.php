<?php

namespace Database\Seeders;

use App\Models\Flight;
use App\Models\Airport;
use App\Models\FlightClass;
use App\Models\FlightSeat;
use Illuminate\Database\Seeder;
class FlightSeeder extends Seeder
{
    public function run()
    {
        $numberOfFlights = 50;
        $airportIds = Airport::pluck('id')->toArray();

        for ($i = 0; $i < $numberOfFlights; $i++) {
            $originAirportId = $this->getRandomAirportId($airportIds);
            $destinationAirportId = $this->getRandomAirportId($airportIds, $originAirportId);

            $data = [
                'airport_origin_id' => $originAirportId,
                'airport_destination_id' => $destinationAirportId,
                'flight_date' => convertBrDateToUs(now()->addDays(random_int(1, 30))->format('d/m/Y')),
                'departure_time' => now()->addHours(random_int(1, 12))->format('H:i:s'),
                'flight_classes' => [
                    ['class' => random_int(1, 2), 'limit' => 5],
                    ['class' => random_int(3, 4), 'limit' => 5]
                ],
                'seats_qty' => 10,
                'flight_number' => generateRandomNumber()
            ];
        
            $flightClasses = $data['flight_classes'];
            unset($data['flight_classes']);
          
            $flight = Flight::create($data);
         
            // Associar as classes ao voo
            foreach ($flightClasses as $item) {
                FlightClass::create([
                    'flight_id' => $flight->id,
                    'travel_class_id' => $item['class'],
                    'seats_limit' => $item['limit']
                ]);
            }

            //criar os assentos
            $seatsData = [];

            foreach ($flightClasses as $class) {
                for ($j = 1; $j <= $class['limit']; $j++) {
                    $seatsData[] = [
                        'flight_id' => $flight->id,
                        'seat_number' => $j,
                        'is_occupied' => false,
                        'travel_class_id' => $class['class'],
                        'travel_flight' => config('enums.travel_classes.status')[$class['class']],
                    ];

                    FlightSeat::insert($seatsData);
                }
            }
        }
    }

    protected function getRandomAirportId(array $airportIds, $excludeId = null)
    {
        $availableIds = array_diff($airportIds, [$excludeId]);

        return $availableIds[array_rand($availableIds)];
    }
}