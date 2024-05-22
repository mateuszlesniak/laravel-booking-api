<?php

declare(strict_types=1);

namespace App\Reservation\UI\Controller;

use App\Common\Application\Bus\CommandBus;
use App\Common\Infrastructure\Http\Controllers\Controller;
use App\Reservation\Application\Exception\ModelNotFoundException;
use App\Reservation\Application\Mapper\ReservationMapper;
use App\Reservation\Application\UseCase\Command\StoreReservationCommand;
use App\Reservation\Domain\Exception\LocationNotAvailable;
use App\Reservation\Domain\Exception\LocationVacancyNotAvailable;
use App\Reservation\UI\Controller\Request\StoreReservationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class StoreReservation extends Controller
{
    public function __construct(
        private readonly CommandBus $commandBus,
        private readonly ReservationMapper $reservationMapper,
    ) {
    }

    public function __invoke(StoreReservationRequest $request): JsonResponse
    {
        try {
            $reservation = $this->reservationMapper->fromRequest($request);

            $this->commandBus->dispatch(new StoreReservationCommand($reservation));
        } catch (ModelNotFoundException $exception) {
            return $this->jsonResponseException(Response::HTTP_UNPROCESSABLE_ENTITY, $exception);
        } catch (LocationVacancyNotAvailable|LocationNotAvailable $exception) {
            return $this->jsonResponseException(Response::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE, $exception);
        } catch (\InvalidArgumentException|\Exception $exception) {
            return $this->jsonResponseException(Response::HTTP_BAD_REQUEST, $exception);
        }

        return response()->json(null, Response::HTTP_CREATED);
    }
}
