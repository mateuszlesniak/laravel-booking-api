<?php

declare(strict_types=1);

namespace App\Reservation\Application\UseCase\Command;

use App\Common\Application\Bus\Command\Command;
use App\Reservation\Domain\Model\Reservation;

final readonly class StoreReservationCommand implements Command
{
    public function __construct(
        public Reservation $reservation
    ) {
    }
}
