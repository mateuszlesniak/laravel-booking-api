<?php

declare(strict_types=1);

namespace App\Reservation\Application\Mapper;

use App\Location\Domain\Model\ValueObject\LocationCode;
use App\Location\Infrastructure\Model\Eloquent\LocationEntity;
use App\Reservation\Domain\Model\Reservation;
use App\Reservation\Domain\Model\ValueObject\DateIn;
use App\Reservation\Domain\Model\ValueObject\DateOut;
use App\Reservation\Domain\Model\ValueObject\ReservationStatus;
use App\Reservation\Domain\Model\ValueObject\ReservationVacancies;
use App\Reservation\Domain\Model\ValueObject\Status;
use App\Reservation\Infrastructure\Model\Eloquent\ReservationEntity;
use App\Reservation\Infrastructure\Model\Eloquent\ReservationVacancyEntity;
use App\Reservation\UI\Controller\Request\StoreReservationRequest;
use App\User\Domain\Model\User;
use App\User\Domain\Model\ValueObject\Email;
use App\User\Domain\Model\ValueObject\Name;

final readonly class ReservationMapper
{
    public function __construct(
        private ReservationVacancyMapper $reservationVacancyMapper,
    )
    {
    }

    public function fromRequest(StoreReservationRequest $request): Reservation
    {
        return new Reservation(
            id: null,
            user: new User(
                id: null,
                name: new Name(null, true),
                email: new Email('test@example.com'),
            ),
            locationCode: new LocationCode($request->string('location_code')->toString()),
            dateIn: new DateIn($request->string('date_in')->toString()),
            dateOut: new DateOut($request->string('date_out')->toString()),
            persons: $request->integer('persons'),
            reservationVacancies: new ReservationVacancies([]),
            status: new Status(),
        );
    }

    public function fromEloquent(ReservationEntity $entity): Reservation
    {
        $reservationVacancies = $entity->reservationVacancies
            ->map(function (ReservationVacancyEntity $reservationVacancyEntity) {
                return $this->reservationVacancyMapper->fromEloquent($reservationVacancyEntity);
            })
            ->toArray();

        return new Reservation(
            id: $entity->id,
            user: new User(
                id: $entity->user->id,
                name: new Name($entity->user->name),
                email: new Email($entity->user->email),
            ),
            locationCode: new LocationCode($entity->location->location_code),
            dateIn: new DateIn($entity->date_in->format('Y-m-d')),
            dateOut: new DateOut($entity->date_out->format('Y-m-d')),
            persons: $entity->reservationVacancies->first()->persons,
            reservationVacancies: new ReservationVacancies($reservationVacancies),
            status: new Status($entity->status),
        );
    }

    public function toEloquent(
        Reservation $reservation,
        ?ReservationEntity $entity = new ReservationEntity(),
    ): ReservationEntity
    {
        $entity->user_id = 1;
        $entity->location_id = LocationEntity::query()->whereLocationCode($reservation->locationCode)->firstOrFail()->id;
        $entity->date_in = $reservation->dateIn->toDate();
        $entity->date_out = $reservation->dateOut->toDate();
        $entity->status = $reservation->status->value;

        return $entity;
    }
}
