<?php

declare(strict_types=1);

namespace App\Location\Infrastructure\Repository\MySQL;

use App\Common\Domain\ValueObject\Date;
use App\Common\Infrastructure\Repository\BaseRepository;
use App\Location\Application\Mapper\LocationMapper;
use App\Location\Domain\Model\Location;
use App\Location\Domain\Model\ValueObject\LocationCode;
use App\Location\Domain\Repository\ReadLocationRepository as ReadLocationRepositoryInterface;
use App\Location\Infrastructure\Model\Eloquent\LocationEntity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

final class ReadLocationRepository extends BaseRepository implements ReadLocationRepositoryInterface
{
    public function __construct(
        private readonly LocationMapper $locationMapper,
    ) {
    }

    #[\Override]
    public function findAll(): Collection
    {
        return $this->queryBuilder()->get()->map(function (LocationEntity $locationEntity) {
            return LocationMapper::fromEloquent($locationEntity);
        });
    }

    #[\Override]
    public function findByLocationCode(
        LocationCode $locationCode,
        bool $withVacancies = false,
        ?Date $dateFrom = null,
        ?Date $dateTo = null,
    ): Location {
        $location = $this->queryBuilder()->whereLocationCode($locationCode)->firstOrFail();

        return $this->locationMapper->fromEloquent($location, $withVacancies, $dateFrom, $dateTo);
    }

    private function queryBuilder(): Builder
    {
        $query = LocationEntity::query();

        return $query;
    }
}
