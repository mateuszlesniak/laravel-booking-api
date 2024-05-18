<?php

namespace App\Booking\Command;

use App\Bus\Command;

final readonly class CreateReservationCommand implements Command
{

    public function __construct(
        public string $startDate,
        public string $endDate,
    )
    {
    }
}
