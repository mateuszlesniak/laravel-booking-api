<?php

declare(strict_types=1);

namespace App\Location\Infrastructure\Repository\MySQL;

use App\Location\Application\Mapper\VacancyMapper;
use App\Location\Domain\Repository\ReadLocationVacancyRepository as ReadLocationVacancyRepositoryInterface;
use App\Location\Infrastructure\Model\Vacancy;
use App\Shared\Application\Repository\BaseRepository;
use DateTimeInterface;
use Illuminate\Support\Collection;

final class ReadLocationVacancyRepository extends BaseRepository implements ReadLocationVacancyRepositoryInterface
{
    public function __construct(
        private readonly VacancyMapper $vacancyMapper,
        Vacancy $model,
    )
    {
        parent::__construct($model);
    }

    #[\Override] public function findBetweenDates(int $locationId, DateTimeInterface $startDate, DateTimeInterface $endDate,): Collection
    {
        $vacancies = $this->model
            ->whereLocationId($locationId)
            ->whereDate('date', '>=', $startDate)
            ->whereDate('date', '<=', $endDate)
        ->get()        ;

//        Vacancy::get()->
        return $vacancies->map(function (Vacancy $vacancy) {
            return $this->vacancyMapper->fromEntity($vacancy);
        });
    }

}
