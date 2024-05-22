<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Exception;

class LocationNotAvailable extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Location is not available');
    }
}
