<?php

declare(strict_types=1);

namespace App\Location\UI\Controller;

use App\Location\Infrastructure\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class GetLocationList extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(LocationResource::collection(
            Location::all()
        ));
    }
}
