<?php

declare(strict_types=1);

namespace App\Reservation\UI\Controller;

use App\Location\Application\Exception\LocationNotFound;
use App\Reservation\Application\Exception\InsufficientSpaceException;
use App\Reservation\Infrastructure\Bus\Command\CreateReservationCommand;
use App\Reservation\UI\Controller\Request\StoreReservationRequest;
use App\Shared\Application\Bus\CommandBus;
use App\Shared\Infrastructure\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class StoreReservation extends Controller
{
    public function __construct(
        private readonly CommandBus $commandBus,
    ) {
    }

    public function __invoke(StoreReservationRequest $request): JsonResponse
    {
        try {
            $this->commandBus->dispatch(new CreateReservationCommand($request));
        } catch (LocationNotFound $exception) {
            return response()->json($exception->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (InsufficientSpaceException $exception) {
            return response()->json($exception->getMessage(), Response::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE);
        } catch (\InvalidArgumentException|\Exception $exception) {
            return response()->json($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return response()->json(null, Response::HTTP_CREATED);
    }
}
