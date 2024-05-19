<?php

declare(strict_types=1);

namespace App\Booking;

class LocationNotFound extends \Exception
{
    public function __construct(string $locationCode)
    {
        parent::__construct(sprintf('Location with code `%s` not found', $locationCode));
    }
}
