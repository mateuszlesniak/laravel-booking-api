<?php

declare(strict_types=1);

namespace App\Location\Application\Repository;

use App\Location\Infrastructure\Model\Location;

interface ReadLocationRepositoryInterface
{
    public function findByLocationCode(string $locationCode): ?Location;
}
