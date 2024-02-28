<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airports = [
            ['name' => 'Aeroporto Internacional de Brasília', 'city' => 'Brasília', 'country' => 'Brasil', 'iata_code' => 'BSB', 'UF' => 'DF'],
            ['name' => 'Aeroporto Internacional de São Paulo/Guarulhos', 'city' => 'São Paulo', 'country' => 'Brasil', 'iata_code' => 'GRU', 'UF' => 'SP'],
            ['name' => 'Aeroporto Internacional do Rio de Janeiro/Galeão', 'city' => 'Rio de Janeiro', 'country' => 'Brasil', 'iata_code' => 'GIG', 'UF' => 'RJ'],
            ['name' => 'Aeroporto Internacional de Belo Horizonte/Confins', 'city' => 'Belo Horizonte', 'country' => 'Brasil', 'iata_code' => 'CNF', 'UF' => 'MG'],
            ['name' => 'Aeroporto Internacional de Salvador/Deputado Luís Eduardo Magalhães', 'city' => 'Salvador', 'country' => 'Brasil', 'iata_code' => 'SSA', 'UF' => 'BA'],
            ['name' => 'Aeroporto Internacional de Fortaleza/Pinto Martins', 'city' => 'Fortaleza', 'country' => 'Brasil', 'iata_code' => 'FOR', 'UF' => 'CE'],
            ['name' => 'Aeroporto Internacional de Recife/Guararapes', 'city' => 'Recife', 'country' => 'Brasil', 'iata_code' => 'REC', 'UF' => 'PE'],
            ['name' => 'Aeroporto Internacional de Manaus/Eduardo Gomes', 'city' => 'Manaus', 'country' => 'Brasil', 'iata_code' => 'MAO', 'UF' => 'AM'],
            ['name' => 'Aeroporto Internacional de Curitiba/Afonso Pena', 'city' => 'Curitiba', 'country' => 'Brasil', 'iata_code' => 'CWB', 'UF' => 'PR'],
            ['name' => 'Aeroporto Internacional de Porto Alegre/Salgado Filho', 'city' => 'Porto Alegre', 'country' => 'Brasil', 'iata_code' => 'POA', 'UF' => 'RS'],
            ['name' => 'Aeroporto Internacional de São Luís/Marechal Cunha Machado', 'city' => 'São Luís', 'country' => 'Brasil', 'iata_code' => 'SLZ', 'UF' => 'MA'],
            ['name' => 'Aeroporto Internacional de Belém/Júlio Cezar Ribeiro', 'city' => 'Belém', 'country' => 'Brasil', 'iata_code' => 'BEL', 'UF' => 'PA'],
            ['name' => 'Aeroporto Internacional de Goiânia/Santa Genoveva', 'city' => 'Goiânia', 'country' => 'Brasil', 'iata_code' => 'GYN', 'UF' => 'GO'],
            ['name' => 'Aeroporto Internacional de Natal/São Gonçalo do Amarante', 'city' => 'Natal', 'country' => 'Brasil', 'iata_code' => 'NAT', 'UF' => 'RN'],
            ['name' => 'Aeroporto Internacional de João Pessoa/Presidente Castro Pinto', 'city' => 'João Pessoa', 'country' => 'Brasil', 'iata_code' => 'JPA', 'UF' => 'PB'],
            ['name' => 'Aeroporto Internacional de Teresina/Senador Petrônio Portella', 'city' => 'Teresina', 'country' => 'Brasil', 'iata_code' => 'THE', 'UF' => 'PI'],
            ['name' => 'Aeroporto Internacional de Maceió/Zumbi dos Palmares', 'city' => 'Maceió', 'country' => 'Brasil', 'iata_code' => 'MCZ', 'UF' => 'AL'],
            ['name' => 'Aeroporto Internacional de Cuiabá/Marechal Rondon', 'city' => 'Cuiabá', 'country' => 'Brasil', 'iata_code' => 'CGB', 'UF' => 'MT'],
            ['name' => 'Aeroporto Internacional de Campo Grande', 'city' => 'Campo Grande', 'country' => 'Brasil', 'iata_code' => 'CGR', 'UF' => 'MS'],
            ['name' => 'Aeroporto Internacional de Vitória/Eurico de Aguiar Salles', 'city' => 'Vitória', 'country' => 'Brasil', 'iata_code' => 'VIX', 'UF' => 'ES'],
            ['name' => 'Aeroporto Internacional de Florianópolis/Hercílio Luz', 'city' => 'Florianópolis', 'country' => 'Brasil', 'iata_code' => 'FLN', 'UF' => 'SC'],
            ['name' => 'Aeroporto de Congonhas', 'city' => 'São Paulo', 'country' => 'Brasil', 'iata_code' => 'CGH', 'UF' => 'SP'],
            ['name' => 'Aeroporto Santos Dumont', 'city' => 'Rio de Janeiro', 'country' => 'Brasil', 'iata_code' => 'SDU', 'UF' => 'RJ'],
            ['name' => 'Aeroporto de Pampulha', 'city' => 'Belo Horizonte', 'country' => 'Brasil', 'iata_code' => 'PLU', 'UF' => 'MG'],
        ];        
        
        // Dentro do loop de inserção na seeder
        foreach ($airports as $airportData) {
            \App\Models\Airport::create($airportData);
        }
    }
}
