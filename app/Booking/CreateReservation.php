<?php

namespace App\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateReservation extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $startDate = $request->date('start_date');
        $endDate = $request->date('end_date');
    }

}
