<?php

declare(strict_types=1);

namespace App\Location\Infrastructure\Repository\Transformer;

use App\Location\Application\DTO\LocationDTO;
use App\Location\Application\DTO\VacancyDTO;
use App\Location\Infrastructure\Model\Location;
use App\Location\Infrastructure\Model\Vacancy;

class LocationTransformer
{
    public function createLocationDTO(
        Location $location,
        ?LocationDTO $locationDTO = null,
    ): LocationDTO {
        $locationDTO = $locationDTO ?? new LocationDTO();

        $locationDTO
            ->setId($location->id)
            ->setName($location->name)
            ->setAddress($location->address)
            ->setCountryCode($location->country)
            ->setLocationCode($location->location_code);

        return $locationDTO;
    }

    public function createVacancyDTO(
        Vacancy $vacancy,
        ?VacancyDTO $vacancyDTO = null
    ): VacancyDTO {
        $vacancyDTO = $vacancyDTO ?? new VacancyDTO();

        $vacancyDTO
            ->setId($vacancy->id)
            ->setDate(new \DateTimeImmutable($vacancy->date))
            ->setSlots($vacancy->slots);

        return $vacancyDTO;
    }
}
