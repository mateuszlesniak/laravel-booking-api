<?php

declare(strict_types=1);

namespace App\Location\Infrastructure\Repository\Transformer;

use App\Location\Application\DTO\VacancyDTO;
use App\Location\Infrastructure\Model\Vacancy;

class VacancyTransformer
{
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
