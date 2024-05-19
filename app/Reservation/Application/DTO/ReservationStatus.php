<?php

declare(strict_types=1);

namespace App\Reservation\Application\DTO;

use App\Shared\Application\DTO\ApplicationEnum;

enum ReservationStatus
{
    use ApplicationEnum;

    case PLACED;
    case CONFIRMED;
    case EXPIRED;
    case CANCELLED;
}
