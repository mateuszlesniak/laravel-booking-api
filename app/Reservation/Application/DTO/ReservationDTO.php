<?php

declare(strict_types=1);

namespace App\Reservation\Application\DTO;

use App\Location\Application\DTO\LocationDTO;
use App\User\Infrastructure\Model\User;

final class ReservationDTO
{
    private int $id;
    private User $user;
    private \DateTimeInterface $startDate;
    private \DateTimeInterface $endDate;
    private LocationDTO $locationDTO;
    private int $persons;
    private ReservationStatus $status;
    /**
     * @var array|ReservationVacancyDTO[]
     */
    private array $reservationVacancies = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ReservationDTO
    {
        $this->id = $id;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): ReservationDTO
    {
        $this->user = $user;

        return $this;
    }

    public function getStartDate(): \DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): ReservationDTO
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): \DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): ReservationDTO
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getLocationDTO(): LocationDTO
    {
        return $this->locationDTO;
    }

    public function setLocationDTO(LocationDTO $locationDTO): ReservationDTO
    {
        $this->locationDTO = $locationDTO;

        return $this;
    }

    public function getPersons(): int
    {
        return $this->persons;
    }

    public function setPersons(int $persons): ReservationDTO
    {
        $this->persons = $persons;

        return $this;
    }

    public function getStatus(): ReservationStatus
    {
        return $this->status;
    }

    public function setStatus(ReservationStatus $status): ReservationDTO
    {
        $this->status = $status;

        return $this;
    }

    public function getReservationVacancies(): array
    {
        return $this->reservationVacancies;
    }

    public function setReservationVacancies(array $reservationVacancies): ReservationDTO
    {
        $this->reservationVacancies = $reservationVacancies;

        return $this;
    }

    public function addReservationVacancies(ReservationVacancyDTO $reservationVacancy): ReservationDTO
    {
        $this->reservationVacancies[] = $reservationVacancy;

        return $this;
    }
}
