<?php

declare(strict_types=1);

namespace App\Reservation\Application\Mapper;

use App\Location\Infrastructure\Model\Eloquent\LocationEntity;
use App\Reservation\Domain\Model\Reservation;
use App\Reservation\Domain\Model\ValueObject\DateIn;
use App\Reservation\Domain\Model\ValueObject\DateOut;
use App\Reservation\Domain\Model\ValueObject\Location;
use App\Reservation\Domain\Model\ValueObject\ReservationVacancies;
use App\Reservation\Domain\Model\ValueObject\User;
use App\Reservation\Infrastructure\Model\Eloquent\ReservationEntity;
use App\Reservation\Infrastructure\Model\Eloquent\ReservationVacancyEntity;
use App\Reservation\UI\Controller\Request\StoreReservationRequest;

final readonly class ReservationMapper
{
    public function __construct(
        private ReservationVacancyMapper $reservationVacancyMapper,
    ) {
    }

    public function fromRequest(StoreReservationRequest $request): Reservation
    {
        return new Reservation(
            id: null,
            user: new User('test@example.com'),
            location: new Location($request->string('location_code')->toString()),
            dateIn: new DateIn($request->string('date_in')->toString()),
            dateOut: new DateOut($request->string('date_out')->toString()),
            persons: $request->integer('persons'),
            reservationVacancies: new ReservationVacancies([]),
        );
    }

    public function fromEloquent(
        ReservationEntity $entity,
        ?\DateTimeInterface $dateFrom,
        ?\DateTimeInterface $dateTo,
    ): Reservation {
        $reservationVacancies = $entity->reservationVacancies
            ->filter(
                function (ReservationVacancyEntity $reservationVacancyEntity) use ($dateFrom, $dateTo) {
                    if (!$dateFrom || !$dateTo) {
                        return true;
                    }

                    $reservationVacancyDate = $reservationVacancyEntity->vacancy->date;

                    return $reservationVacancyDate->betweenIncluded($dateFrom, $dateTo);
                })
            ->map(function (ReservationVacancyEntity $reservationVacancyEntity) {
                return $this->reservationVacancyMapper->fromEloquent($reservationVacancyEntity);
            })
            ->toArray();

        return new Reservation(
            id: $entity->id,
            user: new User($entity->user->email),
            location: new Location($entity->location->location_code),
            dateIn: new DateIn($entity->date_in->format('Y-m-d')),
            dateOut: new DateOut($entity->date_out->format('Y-m-d')),
            persons: $entity->reservationVacancies->first()->persons,
            reservationVacancies: new ReservationVacancies($reservationVacancies),
        );
    }

    public function toEloquent(
        Reservation $reservation,
        ?ReservationEntity $entity = new ReservationEntity(),
    ): ReservationEntity {
        $entity->user_id = 1;
        $entity->location_id = LocationEntity::query()->whereLocationCode($reservation->location->value)->firstOrFail()->id;
        $entity->date_in = $reservation->dateIn->toDate();
        $entity->date_out = $reservation->dateOut->toDate();

        return $entity;
    }
}
