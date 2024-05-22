<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Model\ValueObject;

use App\Common\Domain\ValueObject\ValueObjectArray;
use App\Reservation\Domain\Model\Entity\ReservationVacancy;

class ReservationVacancies extends ValueObjectArray
{
    public function __construct(array $reservationVacancies)
    {
        foreach ($reservationVacancies as $reservationVacancy) {
            if (!$reservationVacancy instanceof ReservationVacancy) {
                throw new \InvalidArgumentException('Invalid reservation vacancy');
            }
        }

        parent::__construct($reservationVacancies);
    }

    public function add(ReservationVacancy $reservationVacancy): void
    {
        $this->append($reservationVacancy);
    }

    #[\Override]
    public function jsonSerialize(): array
    {
        return array_values($this->getArrayCopy());
    }

    /**
     * @return array|ReservationVacancy[]
     */
    public function toArray(): array
    {
        return $this->getArrayCopy();
    }
}
