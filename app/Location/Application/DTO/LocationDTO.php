<?php

declare(strict_types=1);

namespace App\Location\Application\DTO;

final class LocationDTO
{
    private int $id;
    private string $name;
    private string $address;
    private string $countryCode;
    private string $locationCode;
    private bool $isActive;

    /**
     * @var array|VacancyDTO[]
     */
    private array $vacancies;

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): LocationDTO
    {
        $this->address = $address;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): LocationDTO
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): LocationDTO
    {
        $this->name = $name;

        return $this;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): LocationDTO
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function getLocationCode(): string
    {
        return $this->locationCode;
    }

    public function setLocationCode(string $locationCode): LocationDTO
    {
        $this->locationCode = $locationCode;

        return $this;
    }

    public function getVacancies(): array
    {
        return $this->vacancies;
    }

    public function setVacancies(array $vacancies): LocationDTO
    {
        $this->vacancies = $vacancies;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): LocationDTO
    {
        $this->isActive = $isActive;
        return $this;
    }
}
