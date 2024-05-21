<?php

namespace App\Reservation\Domain\Exception;

use Exception;

class LocationNotAvailable extends Exception
{
    public function __construct()
    {
        parent::__construct('Location is not available');
    }
}
