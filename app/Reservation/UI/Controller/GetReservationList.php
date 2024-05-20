<?php

declare(strict_types=1);

namespace App\Reservation\UI\Controller;

use App\Reservation\Infrastructure\Bus\Query\SearchUserReservationQuery;
use App\Reservation\Infrastructure\Http\SearchReservationDTO;
use App\Reservation\UI\Controller\Resource\ReservationCollection;
use App\Shared\Application\Bus\QueryBus;
use App\Shared\Infrastructure\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetReservationList extends Controller
{

    public function __construct(
        private readonly QueryBus $queryBus,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $payload = $this->extractPayload($request, SearchReservationDTO::class);
        $query = new SearchUserReservationQuery($payload);

        $this->queryBus->query($query);

        return response()->json(ReservationCollection::collection($query->getReservations()));
    }


}
