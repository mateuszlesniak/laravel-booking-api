<?php

declare(strict_types=1);

namespace App\Location\Domain\Repository;

use App\Location\Application\DTO\LocationDTO;

interface ReadLocationRepository
{
    public function findAll(): array;

    public function findByLocationCode(string $locationCode): ?LocationDTO;
}
