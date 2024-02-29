<?php

namespace App\Exceptions;

use Exception;

class InvalidFlightTimeException extends Exception
{
    public function __construct($message = 'Invalid flight time', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
