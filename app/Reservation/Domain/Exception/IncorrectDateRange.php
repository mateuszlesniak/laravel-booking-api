<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Exception;

class IncorrectDateRange extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Check out date must be after check in date');
    }
}
