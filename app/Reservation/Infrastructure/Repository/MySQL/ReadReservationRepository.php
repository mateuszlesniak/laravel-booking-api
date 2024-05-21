<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository\MySQL;

use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Application\Mapper\ReservationMapper;
use App\Reservation\Domain\Repository\ReadReservationRepository as ReadReservationRepositoryInterface;
use App\Reservation\Infrastructure\Model\Reservation;
use App\Shared\Application\Repository\BaseRepository;
use App\User\Application\DTO\UserDTO;

final class ReadReservationRepository extends BaseRepository implements ReadReservationRepositoryInterface
{
    public function __construct(
        private readonly ReservationMapper $reservationTransformer,
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
            $reservations[] = $this->reservationTransformer->fromEntity($reservation);
        }

        return $reservations;
    }
}
