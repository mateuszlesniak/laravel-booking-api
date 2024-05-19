<?php

namespace App\Booking;

use Exception;

final class ReservationService
{
    public function validateReservationDetails(ReservationDTO $reservationDTO): void
    {
        throw new Exception();
    }

    public function createReservation(ReservationDTO $reservationDTO): void
    {
    }
}
