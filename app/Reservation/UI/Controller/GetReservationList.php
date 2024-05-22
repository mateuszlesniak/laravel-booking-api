<?php

declare(strict_types=1);

namespace App\Reservation\UI\Controller;

use App\Common\Application\Bus\QueryBus;
use App\Common\Infrastructure\Http\Controllers\Controller;
use App\Reservation\Application\UseCase\Query\FindAllUserReservationsQuery;
use App\Reservation\UI\Controller\Request\FindUserReservationsRequest;
use App\Reservation\UI\Controller\Resource\ReservationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class GetReservationList extends Controller
{
    public function __construct(
        private readonly QueryBus $queryBus,
    ) {
    }

    public function __invoke(FindUserReservationsRequest $request): JsonResponse
    {
        try {
            $query = new FindAllUserReservationsQuery($request);
            $this->queryBus->query($query);

            return response()->json(ReservationResource::collection($query->toArray()));
        } catch (\DomainException $exception) {
            return $this->jsonResponseException(Response::HTTP_UNPROCESSABLE_ENTITY, $exception);
        } catch (\Exception $exception) {
            return $this->jsonResponseException(Response::HTTP_BAD_REQUEST);
        }
    }
}
