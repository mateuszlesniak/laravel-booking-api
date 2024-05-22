<?php

declare(strict_types=1);

namespace App\Reservation\UI\Controller;

use App\Common\Application\Bus\CommandBus;
use App\Common\Infrastructure\Http\Controllers\Controller;
use App\Location\Application\Exception\LocationNotFound;
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
        } catch (LocationNotFound $exception) {
            return $this->jsonResponseException($exception, Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (LocationVacancyNotAvailable|LocationNotAvailable $exception) {
            return $this->jsonResponseException($exception, Response::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE);
        } catch (\InvalidArgumentException|\Exception $exception) {
            return $this->jsonResponseException($exception, Response::HTTP_BAD_REQUEST);
        }

        return response()->json(null, Response::HTTP_CREATED);
    }
}
