<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TravelClassSeeder extends Seeder
{
    public function run()
    {
        $classes = [
            ['title' => 'Econômica'],
            ['title' => 'Premium Econômica'],
            ['title' => 'Executiva'],
            ['title' => 'Primeira Classe']
        ];

        DB::table('travel_classes')->insert($classes);
    }
}