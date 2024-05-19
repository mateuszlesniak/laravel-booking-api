<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Model;

use App\Location\Infrastructure\Model\Vacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ReservationVacancy extends Model
{
    public function vacancy(): HasOne
    {
        return $this->hasOne(Vacancy::class);
    }
}
