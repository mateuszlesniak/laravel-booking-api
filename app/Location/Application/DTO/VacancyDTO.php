<?php

declare(strict_types=1);

namespace App\Location\Application\DTO;

class VacancyDTO
{
    private int $id;
    private \DateTimeImmutable $date;
    private int $slots;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): VacancyDTO
    {
        $this->id = $id;

        return $this;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): VacancyDTO
    {
        $this->date = $date;

        return $this;
    }

    public function getSlots(): int
    {
        return $this->slots;
    }

    public function setSlots(int $slots): VacancyDTO
    {
        $this->slots = $slots;

        return $this;
    }
}
