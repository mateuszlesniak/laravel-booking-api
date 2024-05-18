<?php

namespace App\Booking\Command;

use App\Bus\CommandHandler;

class CreateReservationCommandHandler implements CommandHandler
{
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

        dd($command);
    }

}
