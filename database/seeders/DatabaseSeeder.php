<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

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
