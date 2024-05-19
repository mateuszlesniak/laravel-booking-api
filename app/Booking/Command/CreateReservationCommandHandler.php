<?php

declare(strict_types=1);

namespace App\Booking\Command;

use App\Application\Bus\CommandHandler;
use App\Booking\ReservationService;

final readonly class CreateReservationCommandHandler implements CommandHandler
{
    public function __construct(
        private ReservationService $reservationService,
    ) {
    }

    public function handle(CreateReservationCommand $command): void
    {
        /**
         * @todo
         * - get dates and location
         * - check if location id exists
         * - check if location has available room for given persons and date range
         * - make reservation
         *
         * * use ReservationService class
         */
        $startDate = $command->payload->getStartDate();
        $endDate = $command->payload->getEndDate();

        dd($command);
    }
}
