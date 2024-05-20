<?php

declare(strict_types=1);

namespace App\Location\Application\Repository;

use App\Location\Application\DTO\LocationDTO;

interface ReadLocationRepositoryInterface
{
    public function findAll(): array;

    public function findByLocationCode(string $locationCode): ?LocationDTO;
}
