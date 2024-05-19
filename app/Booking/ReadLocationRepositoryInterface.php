<?php

declare(strict_types=1);

namespace App\Booking;

use App\Models\Location;

interface ReadLocationRepositoryInterface
{
    public function findByLocationCode(string $locationCode): ?Location;
}
