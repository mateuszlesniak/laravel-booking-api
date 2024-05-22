<?php

declare(strict_types=1);

namespace App\Location\Infrastructure\Repository\MySQL;

use App\Location\Application\Mapper\LocationMapper;
use App\Location\Domain\Model\Location;
use App\Location\Domain\Repository\ReadLocationRepository as ReadLocationRepositoryInterface;
use App\Location\Infrastructure\Model\Eloquent\LocationEntity;
use Illuminate\Support\Collection;

final class ReadLocationRepository implements ReadLocationRepositoryInterface
{
    private ?\DateTimeInterface $restrictedDateFrom = null;
    private ?\DateTimeInterface $restrictedDateTo = null;

    public function __construct(
        private readonly LocationMapper $locationMapper,
    ) {
    }

    #[\Override]
    public function findAll(): Collection
    {
        return LocationEntity::all()->map(function (LocationEntity $locationEntity) {
            return LocationMapper::fromEloquent($locationEntity);
        });
    }

    #[\Override]
    public function findByLocationCode(string $locationCode): Location
    {
        $location = LocationEntity::query()->whereLocationCode($locationCode)->firstOrFail();

        return $this->locationMapper->fromEloquent(
            $location,
            $this->restrictedDateFrom,
            $this->restrictedDateTo,
        );
    }

    public function restrictDates(
        \DateTimeInterface $dateFrom,
        \DateTimeInterface $dateTo,
    ): self {
        $this->restrictedDateFrom = $dateFrom;
        $this->restrictedDateTo = $dateTo;

        return $this;
    }
}
