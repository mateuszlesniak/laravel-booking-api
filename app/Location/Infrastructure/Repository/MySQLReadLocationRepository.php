<?php

declare(strict_types=1);

namespace App\Location\Infrastructure\Repository;

use App\Location\Application\Repository\ReadLocationRepositoryInterface;
use App\Location\Infrastructure\Model\Location;

final class MySQLReadLocationRepository implements ReadLocationRepositoryInterface
{
    #[\Override]
    public function findByLocationCode(string $locationCode): ?Location
    {
        return Location::whereLocationCode($locationCode)->first();
    }
}
