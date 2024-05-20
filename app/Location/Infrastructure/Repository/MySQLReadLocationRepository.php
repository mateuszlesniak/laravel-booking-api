<?php

declare(strict_types=1);

namespace App\Location\Infrastructure\Repository;

use App\Location\Application\DTO\LocationDTO;
use App\Location\Application\Repository\ReadLocationRepositoryInterface;
use App\Location\Infrastructure\Model\Location;
use App\Location\Infrastructure\Repository\Transformer\LocationTransformer;
use App\Shared\Infrastructure\Repository\BaseRepository;

final class MySQLReadLocationRepository extends BaseRepository implements ReadLocationRepositoryInterface
{
    public function __construct(
        private readonly LocationTransformer $locationTransformer,
        Location $model,
    ) {
        parent::__construct($model);
    }

    #[\Override]
    public function findAll(): array
    {
        $locations = [];

        foreach ($this->model->all() as $location) {
            $locations[] = $this->locationTransformer->createLocationDTO($location);
        }

        return $locations;
    }

    #[\Override]
    public function findByLocationCode(string $locationCode): ?LocationDTO
    {
        $location = $this->model->whereLocationCode($locationCode)->first();

        if (!$location) {
            return null;
        }

        return $this->locationTransformer->createLocationDTO($location);
    }
}
