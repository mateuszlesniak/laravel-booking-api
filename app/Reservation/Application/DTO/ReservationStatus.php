<?php

declare(strict_types=1);

namespace App\Reservation\Application\DTO;

enum ReservationStatus: string
{
    case NEW = 'New';
    case PLACED = 'Placed';
    case CONFIRMED = 'Confirmed';
    case EXPIRED = 'Expired';
    case CANCELLED = 'Cancelled';
}
