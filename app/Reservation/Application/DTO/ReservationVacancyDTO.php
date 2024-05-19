<?php

declare(strict_types=1);

namespace App\Reservation\Application\DTO;

use App\Location\Application\DTO\VacancyDTO;

final class ReservationVacancyDTO
{
    private VacancyDTO $vacancyDTO;
    private int $persons;

    public function getVacancyDTO(): VacancyDTO
    {
        return $this->vacancyDTO;
    }

    public function setVacancyDTO(VacancyDTO $vacancyDTO): ReservationVacancyDTO
    {
        $this->vacancyDTO = $vacancyDTO;

        return $this;
    }

    public function getPersons(): int
    {
        return $this->persons;
    }

    public function setPersons(int $persons): ReservationVacancyDTO
    {
        $this->persons = $persons;

        return $this;
    }
}
