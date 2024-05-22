<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository\MySQL;

use App\Common\Domain\ValueObject\Date;
use App\Common\Infrastructure\Repository\BaseRepository;
use App\Location\Domain\Model\ValueObject\LocationCode;
use App\Reservation\Application\Mapper\ReservationMapper;
use App\Reservation\Domain\Repository\ReadReservationRepository as ReadReservationRepositoryInterface;
use App\Reservation\Infrastructure\Model\Eloquent\ReservationEntity;
use App\User\Domain\Model\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

final class ReadReservationRepository extends BaseRepository implements ReadReservationRepositoryInterface
{
    private const string FILTER_DATE_FROM = 'FILTER_DATE_FROM';
    private const string FILTER_DATE_TO = 'FILTER_DATE_TO';
    private const string FILTER_USER = 'FILTER_USER';
    private const string FILTER_LOCATION_CODE = 'FILTER_LOCATION_CODE';

    public function __construct(
        private readonly ReservationMapper $reservationMapper,
    ) {
        $this->filters = [
            self::FILTER_DATE_FROM => null,
            self::FILTER_DATE_TO => null,
            self::FILTER_USER => null,
            self::FILTER_LOCATION_CODE => null,
        ];
    }

    public function filterDateFrom(Date $dateFrom): self
    {
        return $this->setFilter(self::FILTER_DATE_FROM, $dateFrom);
    }

    public function filterDateTo(Date $dateTo): self
    {
        return $this->setFilter(self::FILTER_DATE_TO, $dateTo);
    }

    public function filterUser(User $user): self
    {
        return $this->setFilter(self::FILTER_USER, $user);
    }

    public function filterLocationCode(LocationCode $locationCode): self
    {
        return $this->setFilter(self::FILTER_LOCATION_CODE, $locationCode);
    }

    #[\Override]
    public function findAll(): Collection
    {
        return $this->queryBuilder()->get()
            ->map(function (ReservationEntity $reservationEntity) {
                return $this->reservationMapper->fromEloquent($reservationEntity);
            });
    }

    private function queryBuilder(): Builder
    {
        $query = ReservationEntity::query();

        if ($this->getFilter(self::FILTER_DATE_TO)) {
            $query->where('date_in', '<=', $this->getFilter(self::FILTER_DATE_TO)->toDate()->format('Y-m-d'));
        }

        if ($this->getFilter(self::FILTER_DATE_FROM)) {
            $query->where('date_out', '>=', $this->getFilter(self::FILTER_DATE_FROM)->toDate()->format('Y-m-d'));
        }

        if ($this->getFilter(self::FILTER_USER)) {
            $query->where('user_id', '=', $this->getFilter(self::FILTER_USER)->id);
        }

        if ($this->getFilter(self::FILTER_LOCATION_CODE)) {
            $query->whereRelation('location', 'location_code', $this->getFilter(self::FILTER_LOCATION_CODE));
        }

        return $query;
    }
}
