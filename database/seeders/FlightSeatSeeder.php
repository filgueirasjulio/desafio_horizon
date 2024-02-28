<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\FlightSeat;
use App\Models\FlightTicket;
use Illuminate\Database\Seeder;
 

class FlightSeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {    
        //vamos atualizar alguns assentos
        $user = User::all();
        $seatsFirst40 = FlightSeat::take($user->count())->get();

        $i = 1;
        foreach($seatsFirst40 as $seat) {
        $seat->update([
            'passenger_id' => $i,
            'is_occupied' => 1
        ]);

        $i++;
        }
    }
}
