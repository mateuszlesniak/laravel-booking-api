<?php

namespace App\Booking;

use App\Application\RequestPayload;
use DateTimeImmutable;
use Exception;

final class CreateReservationPayload extends RequestPayload
{
    private DateTimeImmutable $startDate;
    private DateTimeImmutable $endDate;
    private string $locationCode;
    private int $persons;

    public function __construct()
    {
        $this->requiredFields = [
            'startDate',
            'endDate',
            'locationCode',
            'persons',
        ];
    }

    public function setStartDate(string $startDate): void
    {
        try {
            $this->startDate = new DateTimeImmutable($startDate);
        } catch (Exception) {
            return;
        }
    }

    public function setEndDate(string $endDate): void
    {
        try {
            $this->endDate = new DateTimeImmutable($endDate);
        } catch (Exception) {
            return;
        }
    }

    public function getStartDate(): DateTimeImmutable
    {
        return $this->startDate;
    }

    public function getEndDate(): DateTimeImmutable
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
