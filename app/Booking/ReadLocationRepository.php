<?php

declare(strict_types=1);

namespace App\Booking;

use App\Models\Location;

final class ReadLocationRepository implements ReadLocationRepositoryInterface
{
    #[\Override]
    public function findByLocationCode(string $locationCode): ?Location
    {
        return Location::whereLocationCode($locationCode)->first();
    }
}
