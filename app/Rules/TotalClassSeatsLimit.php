<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class TotalClassSeatsLimit implements Rule
{
    protected $seatsQty;

    public function __construct($seatsQty)
    {
        $this->seatsQty = $seatsQty;
    }

    public function passes($attribute, $value)
    {
        $totalLimit = array_sum(array_column($value, 'limit'));

        return $totalLimit <= $this->seatsQty;
    }

    public function message()
    {
        return 'A quantidade total de assentos das classes não pode ser maior que a quantidade total de assentos disponíveis no voo.';
    }
}