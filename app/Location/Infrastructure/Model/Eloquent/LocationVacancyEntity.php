<?php

declare(strict_types=1);

namespace App\Location\Infrastructure\Model\Eloquent;

use App\Reservation\Infrastructure\Model\Eloquent\ReservationVacancyEntity;
use Database\Factories\VacancyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LocationVacancyEntity extends Model
{
    use HasFactory;

    protected $table = 'vacancies';

    protected $casts = [
        'date' => 'immutable_date',
    ];

    public function reservationVacancies(): HasMany
    {
        return $this->hasMany(ReservationVacancyEntity::class);
    }

    protected static function newFactory()
    {
        return VacancyFactory::new();
    }
}
