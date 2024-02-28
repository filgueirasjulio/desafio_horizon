<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DispatchReason;
use App\Models\User;
use App\Models\FlightClass;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(40)->create();

        /** seeders */
        $this->call(AirportSeeder::class);
        $this->call(TravelClassSeeder::class);
        $this->call(FlightSeeder::class);
        $this->call(FlightSeatSeeder::class);
        $this->call(FlightTicketSeeder::class);
        $this->call(DispatchReasonSeeder::class);
        $this->call(FlightBaggageSeeder::class);
    }
}
