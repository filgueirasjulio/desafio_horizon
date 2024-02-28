<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DispatchReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reasons = [
            ['title' => 'Tamanho da bagagem'],
            ['title' => 'Peso da bagagem'],
            ['title' => 'Compartimentos lotados na área de passageiros'],
            ['title' => 'Objeto proibido para transporte no comportimento da área de passageiros'],   
        ];        
        
        // Dentro do loop de inserção na seeder
        foreach ($reasons as $reason) {
            \App\Models\DispatchReason::create($reason);
        }
    }
}
