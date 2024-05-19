<?php

declare(strict_types=1);

namespace App\Location\Infrastructure\Model;

use App\Reservation\Infrastructure\Model\ReservationVacancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacancy extends Model
{
    use HasFactory;

    public function reservationVacancies(): HasMany
    {
        return $this->hasMany(ReservationVacancy::class);
    }
}
