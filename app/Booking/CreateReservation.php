<?php

declare(strict_types=1);

namespace App\Booking;

use App\Application\Bus\CommandBus;
use App\Booking\Command\CreateReservationCommand;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreateReservation extends Controller
{
    public function __construct(
        private readonly CommandBus $commandBus,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $createReservationPayload = $this->extractArgumentsToObject($request, CreateReservationPayload::class);

            $this->commandBus->dispatch(new CreateReservationCommand($createReservationPayload));
        } catch (\InvalidArgumentException $exception) {
            return response()->json($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return response()->json(null, Response::HTTP_CREATED);
    }
}
