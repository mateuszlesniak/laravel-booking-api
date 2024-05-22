<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Policy;

class ReservationPolicy
{
    public static function store(): bool
    {
        return true;
    }
}
