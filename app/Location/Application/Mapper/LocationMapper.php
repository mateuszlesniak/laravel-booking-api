<?php

declare(strict_types=1);

namespace App\Location\Application\Mapper;

use App\Location\Domain\Model\Location;
use App\Location\Domain\Model\ValueObject\Address;
use App\Location\Domain\Model\ValueObject\Country;
use App\Location\Domain\Model\ValueObject\LocationCode;
use App\Location\Domain\Model\ValueObject\LocationVacancies;
use App\Location\Domain\Model\ValueObject\Name;
use App\Location\Infrastructure\Model\Eloquent\LocationEntity;
use App\Location\Infrastructure\Model\Eloquent\LocationVacancyEntity;

final readonly class LocationMapper
{
    public function __construct(
        private LocationVacancyMapper $vacancyMapper,
    ) {
    }

    public function fromEloquent(
        LocationEntity $entity,
        ?\DateTimeInterface $vacancyDateFrom = null,
        ?\DateTimeInterface $vacancyDateTo = null,
    ): Location {
        $locationVacancies = [];

        if ($vacancyDateFrom || $vacancyDateTo) {
            $locationVacancies = $entity->vacancies()
                ->whereDate('date', '>=', $vacancyDateFrom)
                ->whereDate('date', '<=', $vacancyDateTo)
                ->get()
                ->map(function (LocationVacancyEntity $vacancyEntity) {
                    return $this->vacancyMapper->fromEloquent($vacancyEntity);
                })
                ->toArray();
        }

        return new Location(
            id: $entity->id,
            name: new Name($entity->name),
            address: new Address($entity->address),
            country: new Country($entity->country),
            locationCode: new LocationCode($entity->location_code),
            vacancies: new LocationVacancies($locationVacancies),
            isActive: $entity->is_active,
        );
    }
}
