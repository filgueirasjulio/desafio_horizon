<?php

// app/Helpers.php

use Carbon\Carbon;

if (!function_exists('generateRandomNumber')) {
    /**
     * Gera um número aleatório de 8 dígitos.
     *
     * @return int
     */
    function generateRandomNumber()
    {
        return mt_rand(10000000, 99999999);
    }
}

if (!function_exists('convertBrDateToUs')) {
    /**
     * Converte uma data do formato brasileiro para o formato americano.
     *
     * @param string $brDate
     * @return string
     */
    function convertBrDateToUs($brDate)
    {
        return Carbon::createFromFormat('d/m/Y', $brDate)->format('Y-m-d');
    }
}

if (!function_exists('convertUsDateToBr')) {
    /**
     * Converte uma data do formato brasileiro para o formato americano.
     *
     * @param string $brDate
     * @return string
     */
    function convertUsDateToBr($brDate)
    {
        return Carbon::createFromFormat('Y-m-d', $brDate)->format('d/m/Y');
    }
}

if (!function_exists('convertArrayBrDateToUs')) {
    /**
     * Converte uma data do formato brasileiro para o formato americano.
     *
     * @param string $brDate
     * @return string
     */
    function convertArrayBrDateToUs($brDate)
    {
        $brDateWithouSpaces =  str_replace(' ', '', $brDate);
        $arrayDates = explode(',',  $brDateWithouSpaces);
  
        return [
            'start' => Carbon::createFromFormat('d/m/Y', $arrayDates[0])->format('Y-m-d'),
            'end' => Carbon::createFromFormat('d/m/Y', $arrayDates[1])->format('Y-m-d')
        ];
    }
}


if (!function_exists('calculateAge')) {
    function calculateAge($birthdate)
    {
        // Convert the birthdate to a DateTime object
        $birthdate = new DateTime($birthdate);

        // Get the current date
        $currentDate = new DateTime();

        // Calculate the difference between the two dates
        $difference = $currentDate->diff($birthdate);

        // Return the age
        return $difference->y;
    }
}