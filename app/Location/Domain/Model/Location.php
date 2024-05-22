<?php

declare(strict_types=1);

namespace App\Location\Domain\Model;

use App\Common\Domain\AggregateRoot;
use App\Location\Domain\Model\ValueObject\Address;
use App\Location\Domain\Model\ValueObject\Country;
use App\Location\Domain\Model\ValueObject\LocationCode;
use App\Location\Domain\Model\ValueObject\LocationVacancies;
use App\Location\Domain\Model\ValueObject\Name;

class Location extends AggregateRoot
{
    public function __construct(
        public readonly ?int $id,
        public readonly Name $name,
        public readonly Address $address,
        public readonly Country $country,
        public readonly LocationCode $locationCode,
        public readonly LocationVacancies $vacancies,
        public readonly bool $isActive = false,
    ) {
    }

    #[\Override]
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'country' => $this->country,
            'locationCode' => $this->locationCode,
            'vacancies' => $this->vacancies,
            'is_active' => $this->isActive,
        ];
    }
}
