<?php

declare(strict_types=1);

namespace App\Booking\Command;

use App\Application\Bus\Command;
use App\Booking\CreateReservationPayload;

final readonly class CreateReservationCommand implements Command
{
    public function __construct(
        public CreateReservationPayload $payload
    ) {
    }
}
