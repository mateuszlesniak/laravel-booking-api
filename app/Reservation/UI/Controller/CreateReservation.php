<?php

declare(strict_types=1);

namespace App\Reservation\UI\Controller;

use App\Location\Application\Exception\LocationNotFound;
use App\Reservation\Infrastructure\Bus\Command\CreateReservationCommand;
use App\Reservation\Infrastructure\Http\CreateReservationDTO;
use App\Shared\Application\Bus\CommandBus;
use App\Shared\Infrastructure\Http\Controllers\Controller;
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
            $createReservationPayload = $this->extractPayload($request, CreateReservationDTO::class);

            $this->commandBus->dispatch(new CreateReservationCommand($createReservationPayload));
        } catch (LocationNotFound $exception) {
            return response()->json($exception->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\InvalidArgumentException|\Exception $exception) {
            return response()->json($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return response()->json(null, Response::HTTP_CREATED);
    }
}
