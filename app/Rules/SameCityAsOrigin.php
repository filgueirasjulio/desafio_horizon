<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Airport;

class SameCityAsOrigin implements Rule
{
    protected $originAirportId;

    public function __construct($originAirportId)
    {
        $this->originAirportId = $originAirportId;
    }

    public function passes($attribute, $value)
    {
        $originCity = Airport::where('id', $this->originAirportId)->value('city');
        $destinationCity = Airport::where('id', $value)->value('city');

        return $originCity !== $destinationCity;
    }

    public function message()
    {
        return 'Não é possível indicar uma mesma cidade na origem e no destino.';
    }
}
