<?php

declare(strict_types=1);

namespace App\Location\Application\Mapper;

use App\Location\Application\DTO\VacancyDTO;
use App\Location\Infrastructure\Model\Vacancy;

class VacancyMapper
{
    public function fromEntity(Vacancy $vacancy): VacancyDTO
    {
        return (new VacancyDTO())
            ->setId($vacancy->id)
            ->setDate(new \DateTimeImmutable($vacancy->date))
            ->setSlots($vacancy->slots);
    }
}
