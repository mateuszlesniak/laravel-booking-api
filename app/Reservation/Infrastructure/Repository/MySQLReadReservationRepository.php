<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository;

use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Application\Repository\ReadReservationRepositoryInterface;
use App\Reservation\Infrastructure\Model\Reservation;
use App\Reservation\Infrastructure\Repository\Transformer\ReservationTransformer;
use App\Shared\Infrastructure\Repository\BaseRepository;
use App\User\Application\DTO\UserDTO;

final class MySQLReadReservationRepository extends BaseRepository implements ReadReservationRepositoryInterface
{
    public function __construct(
        private readonly ReservationTransformer $reservationTransformer,
        Reservation $model,
    ) {
        parent::__construct($model);
    }

    /**
     * @return array|ReservationDTO[]
     */
    #[\Override]
    public function findUserReservations(UserDTO $user): array
    {
        $reservations = [];
        foreach ($this->model->whereUserId($user->getId())->get() as $reservation) {
            $reservations[] = $this->reservationTransformer->createReservationDTO($reservation);
        }

        return $reservations;
    }
}
