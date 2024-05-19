<?php

declare(strict_types=1);

namespace App\Booking;

use App\Application\RequestPayload;

final class CreateReservationPayload extends RequestPayload
{
    protected array $requiredFields = [
        'start_date',
        'end_date',
        'location_code',
        'persons',
    ];

    private \DateTimeImmutable $startDate;
    private \DateTimeImmutable $endDate;
    private string $locationCode;
    private int $persons;

    public function setStartDate(\DateTimeImmutable $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function setEndDate(\DateTimeImmutable $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getStartDate(): \DateTimeImmutable
    {
        return $this->startDate;
    }

    public function getEndDate(): \DateTimeImmutable
    {
        return $this->endDate;
    }

    public function getLocationCode(): string
    {
        return $this->locationCode;
    }

    public function setLocationCode(string $locationCode): void
    {
        $this->locationCode = $locationCode;
    }

    public function getPersons(): int
    {
        return $this->persons;
    }

    public function setPersons(int $persons): void
    {
        $this->persons = $persons;
    }
}
