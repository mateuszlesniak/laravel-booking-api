<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Exception;

class LocationVacancyNotAvailable extends \DomainException
{
    public function __construct()
    {
        parent::__construct('There are no places available in the given time slot');
    }
}
