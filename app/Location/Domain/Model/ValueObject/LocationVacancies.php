<?php

declare(strict_types=1);

namespace App\Location\Domain\Model\ValueObject;

use App\Common\Domain\ValueObject\ValueObjectArray;
use App\Location\Domain\Model\Entity\LocationVacancy;

class LocationVacancies extends ValueObjectArray
{
    public function __construct(array $reservationVacancies)
    {
        foreach ($reservationVacancies as $locationVacancy) {
            if (!$locationVacancy instanceof LocationVacancy) {
                throw new \InvalidArgumentException('Invalid location vacancy');
            }
        }

        parent::__construct($reservationVacancies);
    }

    public function add(LocationVacancy $locationVacancy): void
    {
        $this->append($locationVacancy);
    }

    #[\Override]
    public function jsonSerialize(): array
    {
        return array_values($this->getArrayCopy());
    }

    /**
     * @return array|LocationVacancy[]
     */
    public function toArray(): array
    {
        return array_values($this->getArrayCopy());
    }
}
