<?php

declare(strict_types=1);

namespace App\Booking;

use App\Http\Resources\LocationResource;
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
