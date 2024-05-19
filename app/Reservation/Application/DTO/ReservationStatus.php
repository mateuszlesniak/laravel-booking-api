<?php

declare(strict_types=1);

namespace App\Reservation\Application\DTO;

enum ReservationStatus
{
    case PLACED;
    case CONFIRMED;
    case EXPIRED;
    case CANCELLED;
}
