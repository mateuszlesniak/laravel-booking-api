<?php

namespace App\Booking;

enum ReservationStatus
{
    case PLACED;
    case CONFIRMED;
    case EXPIRED;
    case CANCELLED;
}
