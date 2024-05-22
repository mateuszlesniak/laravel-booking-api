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

    protected $fillable = [
        'location_id',
        'date',
        'slots',
    ];

    protected $casts = [
        'location_id' => 'integer',
        'date' => 'immutable_date',
        'slots' => 'integer',
    ];

    public function reservationVacancies(): HasMany
    {
        return $this->hasMany(ReservationVacancyEntity::class, 'vacancy_id', 'id');
    }

    protected static function newFactory()
    {
        return VacancyFactory::new();
    }
}
