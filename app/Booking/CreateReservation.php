<?php

namespace App\Booking;

use App\Booking\Command\CreateReservationCommand;
use App\Bus\CommandBus;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateReservation extends Controller
{

    public function __construct(
        private readonly CommandBus $commandBus,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        /**
         * @todo
         * - configure properly route
         * - get dates, persons and location
         * - pass data to command
         * - serve exceptions
         * - return json response
         */
        $startDate = $request->date('start_date');
        $endDate = $request->date('end_date');

        $this->commandBus->dispatch(
            new CreateReservationCommand(
                '2024-01-01',
                '2024-02-01',
            )
        );
    }

}
