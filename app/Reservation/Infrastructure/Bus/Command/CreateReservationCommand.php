<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Bus\Command;

use App\Reservation\UI\Controller\Request\StoreReservationRequest;
use App\Shared\Application\Bus\Command\Command;

final readonly class CreateReservationCommand implements Command
{
    public function __construct(
        public StoreReservationRequest $request
    ) {
    }
}
