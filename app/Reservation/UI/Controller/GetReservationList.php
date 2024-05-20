<?php

declare(strict_types=1);

namespace App\Reservation\UI\Controller;

use App\Reservation\Infrastructure\Bus\Query\SearchUserReservationQuery;
use App\Reservation\UI\Controller\Request\SearchReservationRequest;
use App\Reservation\UI\Controller\Resource\ReservationResource;
use App\Shared\Application\Bus\QueryBus;
use App\Shared\Infrastructure\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class GetReservationList extends Controller
{
    public function __construct(
        private readonly QueryBus $queryBus,
    ) {
    }

    public function __invoke(SearchReservationRequest $request): JsonResponse
    {
        try {
            $query = new SearchUserReservationQuery($request);

            $this->queryBus->query($query);
        } catch (\Exception) {
            return response()->json(null, Response::HTTP_BAD_REQUEST);
        }

        return response()->json(ReservationResource::collection($query->getReservations()));
    }
}
