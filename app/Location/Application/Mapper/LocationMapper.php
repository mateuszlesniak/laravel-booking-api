<?php

declare(strict_types=1);

namespace App\Location\Application\Mapper;

use App\Location\Application\DTO\LocationDTO;
use App\Location\Infrastructure\Model\Location;

class LocationMapper
{
    public function fromEntity(Location $location): LocationDTO
    {
        return (new LocationDTO())
            ->setId($location->id)
            ->setName($location->name)
            ->setAddress($location->address)
            ->setCountryCode($location->country)
            ->setLocationCode($location->location_code)
            ->setIsActive((bool)$location->is_active);
    }
}
