<?php

declare(strict_types=1);

namespace App\Location\UI\Controller;

use App\Location\Application\Repository\ReadLocationRepositoryInterface;
use App\Location\UI\Controller\Resources\LocationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class GetLocationList extends Controller
{
    public function __construct(
        private readonly ReadLocationRepositoryInterface $locationRepository,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        return response()->json(LocationResource::collection(
            $this->locationRepository->findAll(),
        ));
    }
}
