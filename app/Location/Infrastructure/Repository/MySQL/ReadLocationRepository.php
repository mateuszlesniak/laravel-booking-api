<?php

declare(strict_types=1);

namespace App\Location\Infrastructure\Repository\MySQL;

use App\Location\Application\DTO\LocationDTO;
use App\Location\Application\Mapper\LocationMapper;
use App\Location\Domain\Repository\ReadLocationRepository as ReadLocationRepositoryInterface;
use App\Location\Infrastructure\Model\Location;
use App\Shared\Application\Repository\BaseRepository;

final class ReadLocationRepository extends BaseRepository implements ReadLocationRepositoryInterface
{
    public function __construct(
        private readonly LocationMapper $locationTransformer,
        Location $model,
    ) {
        parent::__construct($model);
    }

    #[\Override]
    public function findAll(): array
    {
        $locations = [];

        foreach ($this->model->all() as $location) {
            $locations[] = $this->locationTransformer->fromEntity($location);
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

        return $this->locationTransformer->fromEntity($location);
    }
}
