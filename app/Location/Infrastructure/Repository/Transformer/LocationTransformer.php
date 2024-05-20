<?php

declare(strict_types=1);

namespace App\Location\Infrastructure\Repository\Transformer;

use App\Location\Application\DTO\LocationDTO;
use App\Location\Infrastructure\Model\Location;

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
}
