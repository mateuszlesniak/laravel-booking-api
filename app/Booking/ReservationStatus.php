<?php

declare(strict_types=1);

namespace App\Booking;

enum ReservationStatus
{
    case PLACED;
    case CONFIRMED;
    case EXPIRED;
    case CANCELLED;
}
