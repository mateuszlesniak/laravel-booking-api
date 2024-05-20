<?php

declare(strict_types=1);

namespace App\Location\Infrastructure\Repository;

use App\Location\Application\DTO\LocationDTO;
use App\Location\Application\Repository\ReadLocationRepositoryInterface;
use App\Location\Infrastructure\Model\Location;
use App\Location\Infrastructure\Repository\Transformer\LocationTransformer;

final readonly class MySQLReadLocationRepository implements ReadLocationRepositoryInterface
{
    public function __construct(
        private LocationTransformer $locationTransformer,
    )
    {
    }

    #[\Override] public function findAll(): array
    {
        $locations = [];

        foreach (Location::all() as $location) {
            $locations[] = $this->locationTransformer->createLocationDTO($location);
        }

        return $locations;
    }

    #[\Override]
    public function findByLocationCode(string $locationCode): ?LocationDTO
    {
        $location = Location::whereLocationCode($locationCode)->first();

        if (!$location) {
            return null;
        }

        return $this->locationTransformer->createLocationDTO($location);
    }
}
